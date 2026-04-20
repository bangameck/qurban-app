<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

#[Layout('components.layouts.app')]
#[Lazy]
class ManajemenUser extends Component
{
    use WithPagination;

    public $search = '';

    public $isModalOpen = false;

    public $isDeleteModalOpen = false;

    public $isResetPasswordModalOpen = false;

    public $editId = null;

    public $deleteId = null;

    public $resetPasswordId = null;

    // Form Properties
    public $id_warga;

    public $email;

    public $status = true;

    public $role = '';

    public function placeholder()
    {
        return view('components.skeleton._user');
    }

    public function messages()
    {
        return [
            'id_warga.required' => 'Warga wajib dipilih!',
            'id_warga.unique' => 'Warga ini sudah memiliki akun user!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.unique' => 'Email ini sudah digunakan!',
        ];
    }

    public function openModal($id = null)
    {
        $this->resetForm();
        if ($id) {
            $this->editId = $id;
            $user = User::with('warga')->find($id);
            $this->id_warga = $user->id_warga;
            $this->email = $user->email;
            $this->status = (bool) $user->status;
            $this->role = $user->roles->first()?->name ?? '';
        }
        $this->isModalOpen = true;
    }

    public function updatedIdWarga($value)
    {
        if ($value && ! $this->editId) {
            $warga = Warga::find($value);
            if ($warga) {
                // Generate email otomatis dari nama warga
                $slug = Str::slug($warga->nama, '.');
                $this->email = $slug.'@qurban.app';
            }
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['editId', 'id_warga', 'email', 'role']);
        $this->status = true;
        $this->resetValidation();
    }

    public function save()
    {
        $rules = [
            'id_warga' => 'required|exists:wargas,id|unique:users,id_warga,'.($this->editId ?? 'NULL'),
            'email'    => 'required|email|unique:users,email,'.($this->editId ?? 'NULL'),
            'status'   => 'boolean',
        ];

        $this->validate($rules);

        $data = [
            'id_warga' => $this->id_warga,
            'email'    => $this->email,
            'status'   => $this->status,
        ];

        if (! $this->editId) {
            $warga = Warga::find($this->id_warga);
            $data['name']     = $warga->nama;
            $data['password'] = Hash::make('password123');
        }

        $user = User::updateOrCreate(['id' => $this->editId], $data);

        // Assign role
        if ($this->role) {
            $user->syncRoles([$this->role]);
        } else {
            $user->syncRoles([]);
        }

        $this->dispatch('notify-success', $this->editId ? 'Data User berhasil diperbarui!' : 'User baru berhasil dibuat!');
        $this->closeModal();
    }

    // --- Toggle Status ---
    public function toggleStatus($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = ! $user->status;
            $user->save();
            $this->dispatch('notify-success', 'Status user berhasil diubah!');
        }
    }

    // --- Reset Password ---
    public function confirmResetPassword($id)
    {
        $this->resetPasswordId = $id;
        $this->isResetPasswordModalOpen = true;
    }

    public function executeResetPassword()
    {
        $user = User::find($this->resetPasswordId);
        if ($user) {
            $user->password = Hash::make('password123');
            $user->save();
            $this->dispatch('notify-success', 'Password user berhasil direset ke "password123"!');
        }
        $this->isResetPasswordModalOpen = false;
        $this->resetPasswordId = null;
    }

    // --- Delete ---
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function executeDelete()
    {
        $user = User::find($this->deleteId);
        if ($user) {
            $user->delete();
            $this->dispatch('notify-success', 'User berhasil dihapus!');
        }
        $this->isDeleteModalOpen = false;
        $this->deleteId = null;
    }

    public function render()
    {
        usleep(200000);
        $users = User::with(['warga', 'roles'])
            ->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            })
            ->latest()
            ->paginate(10);

        $existingWargaIds = User::when($this->editId, function ($q) {
            $q->where('id', '!=', $this->editId);
        })->pluck('id_warga');

        $wargas = Warga::whereNotIn('id', $existingWargaIds)
            ->orderBy('nama', 'asc')
            ->get();

        $roles = Role::orderBy('name')->get();

        return view('livewire.admin.manajemen-user', [
            'users'  => $users,
            'wargas' => $wargas,
            'roles'  => $roles,
        ])->title('Manajemen User');
    }
}
