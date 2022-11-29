<?php

namespace App\Http\Livewire\Table;

use App\Models\HideableColumn;
use App\Models\Archives;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use App\Http\Livewire\Table\LivewireDatatable;

class ArchivesTable extends LivewireDatatable
{
    protected $listeners = ['refreshTable'];
    public $hideable = 'select';
    public $table_name = 'tbl_archives';
    public $hide = [];


    public function builder()
    {
        return Archives::query()->where('jenis_arsip_id', $this->params);
    }

    public function columns()
    {
        $this->hide = HideableColumn::where(['table_name' => $this->table_name, 'user_id' => auth()->user()->id])->pluck('column_name')->toArray();
        return [
            Column::name('nama_arsip')->label('Nama Arsip')->searchable(),
            Column::name('jenisArsip.nama_jenis_arsip')->label('Jenis Arsip')->searchable(),
            Column::name('tanggal_arsip')->label('Tanggal Arsip')->searchable(),
            Column::callback(['file_arsip'], function ($file_arsip) {
                return '<a href="' . asset('storage/upload/' . $file_arsip) . '" target="_blank">' . $file_arsip . '</a>';
            })->label(__('File Arsip')),

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
        $this->emit('getDataArchivesById', $id);
    }

    public function getId($id)
    {
        $this->emit('getArchivesId', $id);
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
