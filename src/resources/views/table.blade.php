<div class="card w-full bg-base-100 shadow-sm border border-base-300">
    <div class="card-body gap-5">
        <div class="card-title flex-col justify-start items-start mb-2">
            <h2 class="text-xl font-semibold text-base-content">📊 Jend Table</h2>
            <p class="text-sm text-base-content/70">🔎 A simple data table with pagination, search, and actions.</p>
        </div>

        <!-- Header Controls -->
        <div class="flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center">
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-base-content/70">Show</span>
                <select wire:model.live="pagination.perPage" class="select select-bordered select-sm w-fit">
                    @foreach ($pagination['perPageOptions'] as $value)
                        <option wire:key="page-{{ $value }}" value="{{ $value }}"
                            @selected($pagination['perPage'] === $value)>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
                <span class="text-sm font-medium text-base-content/70">entries</span>
            </div>

            <div class="form-control">
                <label class="input input-bordered flex items-center gap-2 max-w-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="h-4 w-4 opacity-70">
                        <path fill-rule="evenodd"
                            d="M9.965 11.026a5 5 0 1 1 1.06-1.06l2.755 2.754a.75.75 0 1 1-1.06 1.06l-2.755-2.754ZM10.5 7a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z"
                            clip-rule="evenodd" />
                    </svg>
                    <input type="text" class="grow" placeholder="Search..." wire:model.live.debounce.300ms="search" />
                </label>
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto border border-base-300 rounded-lg">
            <table class="table">
                <thead class="bg-base-200">
                    <tr>
                        <th class="font-semibold text-base-content">
                            <div class="flex items-center gap-2">
                                #
                                <svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                </svg>
                            </div>
                        </th>
                        @foreach ($columns as $column)
                            <th class="font-semibold text-base-content" wire:key="column-{{ $column['key'] }}">
                                <div class="flex items-center gap-2">
                                    {{ $column['label'] }}
                                    <svg class="w-3 h-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4" />
                                    </svg>
                                </div>
                            </th>
                        @endforeach
                        <th class="font-semibold text-base-content">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rows as $index => $row)
                        <tr class="hover:bg-base-200" wire:key="row-{{ $row->id }}">
                            <td class="font-medium">
                                @if ($pagination['enabled'])
                                    {{ ($rows->currentPage() - 1) * $pagination['perPage'] + $loop->iteration }}
                                @else
                                    {{ $loop->iteration }}
                                @endif
                            </td>
                            @foreach ($columns as $column)
                                <td wire:key="cell-{{ $row->id }}-{{ $column['key'] }}">
                                    {{ $row[$column['key']] ?? 'N/A' }}
                                </td>
                            @endforeach
                            <td>
                                <div class="flex items-center gap-2">
                                    <a class="btn btn-ghost text-primary"><svg class="size-5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a class="btn btn-ghost text-warning">
                                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </a>
                                    <button class="btn btn-ghost text-error">
                                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-base-content/70 italic" colspan="{{ count($columns) + 2 }}">
                                No records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        @if ($pagination['enabled'])
            {{ $rows->links('jendtable::pagination') }}
        @endif
    </div>
</div>