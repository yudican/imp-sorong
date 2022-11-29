<?php

namespace App\Http\Livewire\Table;

use App\Models\HideableColumn;
use App\Models\Member;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use App\Http\Livewire\Table\LivewireDatatable;

class MemberTable extends LivewireDatatable
{
    protected $listeners = ['refreshTable'];
    public $hideable = 'select';
    public $table_name = 'tbl_members';
    public $hide = [];


    public function builder()
    {
        return Member::query();
    }

    public function columns()
    {
        $this->hide = HideableColumn::where(['table_name' => $this->table_name, 'user_id' => auth()->user()->id])->pluck('column_name')->toArray();
        return [
            Column::name('user.name')->label('Nama Lengkap')->searchable(),
            Column::name('user.email')->label('Email')->searchable(),
            Column::name('tempat_lahir')->label('Tempat Lahir')->searchable(),
            Column::name('tanggal_lahir')->label('Tanggal Lahir')->searchable(),
            Column::name('agama_lahir')->label('Agama Lahir')->searchable(),
            Column::name('jenis_kelamin')->label('Jenis Kelamin')->searchable(),
            Column::name('nama_ayah')->label('Nama Ayah')->searchable(),
            Column::name('nama_ibu')->label('Nama Ibu')->searchable(),
            Column::name('nama_universitas')->label('Nama Universitas')->searchable(),
            Column::name('nama_prodi')->label('Nama Prodi')->searchable(),
            Column::name('nim')->label('Nim')->searchable(),
            Column::name('nama_bank')->label('Nama Bank')->searchable(),
            Column::name('no_rekening')->label('No Rekening')->searchable(),

            Column::callback(['id'], function ($id) {
                return view('livewire.components.action-button', [
                    'id' => $id,
                    'segment' => request()->segment(1)
                ]);
            })->label(__('Aksi')),
        ];
    }

    public function getDataById($id)
    {
        $this->emit('getDataMemberById', $id);
    }

    public function getId($id)
    {
        $this->emit('getMemberId', $id);
    }

    public function refreshTable()
    {
        $this->emit('refreshLivewireDatatable');
    }

    public function toggle($index)
    {
        if ($this->sort == $index) {
            $this->initialiseSort();
        }

        $column = HideableColumn::where([
            'table_name' => $this->table_name,
            'column_name' => $this->columns[$index]['name'],
            'index' => $index,
            'user_id' => auth()->user()->id
        ])->first();

        if (!$this->columns[$index]['hidden']) {
            unset($this->activeSelectFilters[$index]);
        }

        $this->columns[$index]['hidden'] = !$this->columns[$index]['hidden'];

        if (!$column) {
            HideableColumn::updateOrCreate([
                'table_name' => $this->table_name,
                'column_name' => $this->columns[$index]['name'],
                'index' => $index,
                'user_id' => auth()->user()->id
            ]);
        } else {
            $column->delete();
        }
    }
}
