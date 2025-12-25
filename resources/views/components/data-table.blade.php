@props(['headers' => [], 'search' => true, 'pagination' => null, 'emptyMessage' => 'No data available'])

<div class="bg-white rounded-xl shadow-md overflow-hidden" x-data="{ sortColumn: '', sortDirection: 'asc' }">
    @if($search)
        <!-- Search Bar -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center space-x-4">
                <div class="flex-1 relative">
                    <input type="text" 
                           id="search-input"
                           placeholder="Search..." 
                           class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0066CC] focus:border-[#0066CC] transition-all"
                           @input="filterTable($event.target.value)">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                {{ $filters ?? '' }}
            </div>
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full" id="data-table">
            <thead class="bg-[#F7FAFC] border-b border-gray-200">
                <tr>
                    @foreach($headers as $header)
                        <th class="px-6 py-4 text-left text-xs font-semibold text-[#003366] uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors"
                            @click="sort('{{ Str::slug($header) }}')">
                            <div class="flex items-center space-x-2">
                                <span>{{ $header }}</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                                </svg>
                            </div>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white" id="table-body">
                {{ $slot }}
            </tbody>
        </table>
    </div>

    <!-- Empty State -->
    <div id="empty-state" class="hidden p-12 text-center">
        <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
        </svg>
        <h3 class="mt-4 text-lg font-medium text-[#003366]">{{ $emptyMessage }}</h3>
    </div>

    <!-- Pagination -->
    @if($pagination)
        <div class="px-6 py-4 bg-[#F7FAFC] border-t border-gray-200">
            {{ $pagination->links() }}
        </div>
    @endif
</div>

@push('scripts')
<script>
    function sort(column) {
        // Basic client-side sorting
        const table = document.getElementById('table-body');
        const rows = Array.from(table.querySelectorAll('tr'));
        
        rows.sort((a, b) => {
            const aText = a.cells[0].textContent.trim();
            const bText = b.cells[0].textContent.trim();
            return aText.localeCompare(bText);
        });
        
        rows.forEach(row => table.appendChild(row));
    }

    function filterTable(searchTerm) {
        const table = document.getElementById('table-body');
        const rows = table.querySelectorAll('tr');
        const emptyState = document.getElementById('empty-state');
        let visibleCount = 0;

        searchTerm = searchTerm.toLowerCase();

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            if (text.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Show/hide empty state
        if (visibleCount === 0) {
            document.querySelector('#data-table').style.display = 'none';
            emptyState.classList.remove('hidden');
        } else {
            document.querySelector('#data-table').style.display = 'table';
            emptyState.classList.add('hidden');
        }
    }
</script>
@endpush
