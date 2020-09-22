<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Livewire\Component;

class IndexRoleComponent extends Component
{
    use Table, HasLivewireAuth;

    /** @var string */
    public $sortField = 'name';

    /** @var array */
    protected $queryString = ['perPage', 'sortField', 'sortDirection', 'search'];

    /** @var array */
    protected $listeners = ['entity-deleted' => 'render'];

    /**
     * Render the component view.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $roles = Role::filter([
            'search' => $this->search,
            'orderByField' => [$this->sortField, $this->sortDirection],
        ])->paginate($this->perPage);

        return view('roles.index', ['roles' => $roles])
            ->extends('layouts.app');
    }
}