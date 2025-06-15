<x-dashboard-layout>
            {{-- Conditional rendering of content based on activeView --}}

            {{-- Admin Views --}}
            @if(auth()->check() && auth()->user()->isAdmin())
                @if(isset($activeView) && $activeView === 'admin_plots_index')
                    <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Manage Plots (Admin)</h2>
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots/create']) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Add New Plot
                        </a>
                    </div>
                    <div class="p-6 rounded-xl shadow-lg">
                        @if (session('success'))
                            @php $message = session('success'); @endphp {{-- Assign session value to a variable --}}
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <span class="block sm:inline">{{ $message }}</span>
                            </div>
                        @endif
                        @if ($Plots->isEmpty())
                            <div class="alert bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative">No plots found for administration.</div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Title</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Area (sqm)</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Location</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">New Listing</th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach ($Plots as $plot)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $plot->title }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">${{ number_format($plot->price, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ number_format($plot->area_sqm, 2) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $plot->location }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ ucfirst($plot->status) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $plot->is_new_listing ? 'Yes' : 'No' }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots/' . $plot->id]) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200 mr-2">View</a>
                                                    <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots/' . $plot->id . '/edit']) }}" class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-200 mr-2">Edit</a>
                                                    <form action="{{ route('admin.plots.destroy', $plot->id) }}" method="POST" class="inline-block">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200" onclick="return confirm('Are you sure you want to delete this plot?')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $Plots->links() }}
                            </div>
                        @endif
                    </div>

                @elseif(isset($activeView) && $activeView === 'admin_plots_create')
                    <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Create New Plot (Admin)</h2>
                    <div class="p-6 rounded-xl shadow-lg">
                        <form action="{{ route('admin.plots.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title:</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description:</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>{{ old('description') }}</textarea>
                                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price ($):</label>
                                <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="area_sqm" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Area (sqm):</label>
                                <input type="number" id="area_sqm" name="area_sqm" step="0.01" value="{{ old('area_sqm') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('area_sqm')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location:</label>
                                <input type="text" id="location" name="location" value="{{ old('location') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('location')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status:</label>
                                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                    <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                    <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                                    <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>Reserved</option>
                                </select>
                                @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4 flex items-center">
                                <input type="checkbox" id="is_new_listing" name="is_new_listing" value="1" {{ old('is_new_listing') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                <label for="is_new_listing" class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Is New Listing?</label>
                                @error('is_new_listing')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots']) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">Cancel</a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Create Plot</button>
                            </div>
                        </form>
                    </div>

                @elseif(isset($activeView) && $activeView === 'admin_plots_edit')
                    <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Edit Plot (Admin) - {{ $plot->title }}</h2>
                    <div class="p-6 rounded-xl shadow-lg">
                        <form action="{{ route('admin.plots.update', $plot->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title:</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $plot->title) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description:</label>
                                <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>{{ old('description', $plot->description) }}</textarea>
                                @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price ($):</label>
                                <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $plot->price) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="area_sqm" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Area (sqm):</label>
                                <input type="number" id="area_sqm" name="area_sqm" step="0.01" value="{{ old('area_sqm', $plot->area_sqm) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('area_sqm')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location:</label>
                                <input type="text" id="location" name="location" value="{{ old('location', $plot->location) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                @error('location')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status:</label>
                                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                                    <option value="available" {{ (old('status', $plot->status) == 'available') ? 'selected' : '' }}>Available</option>
                                    <option value="sold" {{ (old('status', $plot->status) == 'sold') ? 'selected' : '' }}>Sold</option>
                                    <option value="reserved" {{ (old('status', $plot->status) == 'reserved') ? 'selected' : '' }}>Reserved</option>
                                </select>
                                @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-4 flex items-center">
                                <input type="checkbox" id="is_new_listing" name="is_new_listing" value="1" {{ old('is_new_listing', $plot->is_new_listing) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                                <label for="is_new_listing" class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">Is New Listing?</label>
                                @error('is_new_listing')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots']) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">Cancel</a>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">Update Plot</button>
                            </div>
                        </form>
                    </div>

                @elseif(isset($activeView) && $activeView === 'admin_plots_show')
                    <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Plot Details (Admin) - {{ $plot->title }}</h2>
                    <div class="p-6 rounded-xl shadow-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="col-span-2"><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Title:</strong> {{ $plot->title }}</p></div>
                            <div class="col-span-2"><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Description:</strong></p><p class="text-gray-900 dark:text-gray-100 mt-1">{{ $plot->description }}</p></div>
                            <div><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Price:</strong> ${{ number_format($plot->price, 2) }}</p></div>
                            <div><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Area:</strong> {{ number_format($plot->area_sqm, 2) }} sqm</p></div>
                            <div><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Location:</strong> {{ $plot->location }}</p></div>
                            <div><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Status:</strong> {{ ucfirst($plot->status) }}</p></div>
                            <div><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>New Listing:</strong> {{ $plot->is_new_listing ? 'Yes' : 'No' }}</p></div>
                            <div class="col-span-2"><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Created At:</strong> {{ $plot->created_at->format('M d, Y H:i A') }}</p></div>
                            <div class="col-span-2"><p class="text-sm font-medium text-gray-700 dark:text-gray-300"><strong>Last Updated:</strong> {{ $plot->updated_at->format('M d, Y H:i A') }}</p></div>
                        </div>
                        <div class="mt-6 flex justify-start">
                            <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots/' . $plot->id . '/edit']) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mr-2">Edit</a>
                            <a href="{{ route('dashboard', ['viewType' => 'admin', 'id' => 'plots']) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Back to List</a>
                        </div>
                    </div>
                @else {{-- Customer Views (or default if not admin) --}}
                    @if (isset($activeView) && $activeView === 'single_plot')
                        {{-- Content from customer/plots/show.blade.php --}}
                        <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Plot Details: {{ $plot->title }}</h2>
                        <div class="p-6 rounded-xl shadow-lg">
                            @if ($plot->status !== 'available')
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                                    <span class="block sm:inline">This plot is currently {{ ucfirst($plot->status) }} and not available for purchase.</span>
                                </div>
                            @endif
                            <div class="mb-4"><p class="text-gray-700 dark:text-gray-300"><strong class="font-semibold">Price:</strong> ${{ number_format($plot->price, 2) }}</p></div>
                            <div class="mb-4"><p class="text-gray-700 dark:text-gray-300"><strong class="font-semibold">Area:</strong> {{ number_format($plot->area_sqm, 2) }} sqm</p></div>
                            <div class="mb-4"><p class="text-gray-700 dark:text-gray-300"><strong class="font-semibold">Location:</strong> {{ $plot->location }}</p></div>
                            <div class="mb-4"><p class="text-gray-700 dark:text-gray-300"><strong class="font-semibold">Status:</strong> {{ ucfirst($plot->status) }}</p></div>
                            <div class="mb-4"><p class="text-gray-700 dark:text-gray-300"><strong class="font-semibold">New Listing:</strong> {{ $plot->is_new_listing ? 'Yes' : 'No' }}</p></div>
                            <div class="mb-6"><p class="text-gray-700 dark:text-gray-300"><strong class="font-semibold">Listed On:</strong> {{ $plot->created_at->format('M d, Y') }}</p></div>
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 mt-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-3">Description</h3>
                                <p class="text-gray-800 dark:text-gray-200 leading-relaxed">{{ $plot->description }}</p>
                            </div>
                            <div class="mt-8">
                                <a href="{{ route('dashboard', ['viewType' => 'plots']) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Back to All Plots</a>
                            </div>
                        </div>
                    @elseif (isset($activeView) && $activeView === 'all_plots')
                        {{-- Content from customer/plots/index.blade.php --}}
                        <h2 class="text-3xl font-bold mb-6 text-black">Available Plots</h2>
                        <div class="flex flex-col sm:flex-row mb-4 gap-4 items-center justify-between">
                            <div class="w-full sm:w-auto">
                                <form action="{{ route('dashboard', ['viewType' => 'plots']) }}" method="GET" class="w-full">
                                    <div class="relative">
                                        <input type="text" name="search" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" placeholder="Search plots..." value="{{ request('search') }}">
                                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    </div>
                                </form>
                            </div>
                            <div class="flex flex-wrap gap-2 w-full sm:w-auto justify-end">
                                <a href="{{ route('dashboard', ['viewType' => 'plots', 'new_listings' => true]) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Show New Listings Only</a>
                                <a href="{{ route('dashboard', ['viewType' => 'plots']) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:bg-gray-600 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">Clear Filters</a>
                            </div>
                        </div>
                        <div class="p-6 rounded-xl shadow-lg">
                            @if($Plots->isEmpty())
                                <div class="alert bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative">No plots available matching your criteria.</div>
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($Plots as $plot)
                                        <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                                            @if($plot->is_new_listing)
                                                <div class="badge bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full absolute top-3 right-3 z-10">New</div>
                                            @endif
                                            <div class="p-4 flex-grow">
                                                <h5 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $plot->title }}</h5>
                                                <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">{{ Str::limit($plot->description, 100) }}</p>
                                                <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                                                    <li class="flex justify-between items-center py-1"><strong>Price:</strong><span>${{ number_format($plot->price, 2) }}</span></li>
                                                    <li class="flex justify-between items-center py-1"><strong>Area:</strong><span>{{ number_format($plot->area_sqm, 2) }} sqm</span></li>
                                                    <li class="flex justify-between items-center py-1"><strong>Location:</strong><span>{{ $plot->location }}</span></li>
                                                </ul>
                                            </div>
                                            <div class="p-4 border-t border-gray-200 dark:border-gray-600">
                                                <a href="{{ route('dashboard', ['viewType' => 'plot', 'id' => $plot->id]) }}" class="block w-full text-center px-4 py-2 bg-yellow-500 text-white rounded-md font-semibold text-sm uppercase tracking-widest hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">View Details</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-6 flex justify-center">
                                    {{ $Plots->appends(request()->query())->links() }}
                                </div>
                            @endif
                        </div>
                    @else
                        {{-- Default dashboard overview content --}}
                        <h2 class="text-3xl font-bold mb-6">My Dashboard - Overview</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                            <div class="card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                                <div><p class="text-gray-500 text-sm font-medium">Available Plots</p><p class="text-4xl font-bold text-indigo-700 mt-2">205</p></div>
                                <div class="text-indigo-400 text-5xl"><i class="fas fa-map-marker-alt"></i></div>
                            </div>
                            <div class="card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                                <div><p class="text-gray-500 text-sm font-medium">New Listings (30 Days)</p><p class="text-4xl font-bold text-green-600 mt-2">22</p></div>
                                <div class="text-green-400 text-5xl"><i class="fas fa-chart-line"></i></div>
                            </div>
                            <div class="card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                                <div><p class="text-gray-500 text-sm font-medium">Your Inquiries (Pending)</p><p class="text-4xl font-bold text-orange-600 mt-2">3</p></div>
                                <div class="text-orange-400 text-5xl"><i class="fas fa-calendar-alt"></i></div>
                            </div>
                            <div class="card bg-white p-6 rounded-xl shadow-lg flex items-center justify-between">
                                <div><p class="text-gray-500 text-sm font-medium">Avg. Plot Price (per sqm)</p><p class="text-4xl font-bold text-purple-700 mt-2">K 50,000</p></div>
                                <div class="text-purple-400 text-5xl"><i class="fas fa-dollar-sign"></i></div>
                            </div>
                        </div>
                        
                        
                        <div class="bg-white p-6 rounded-xl shadow-lg">
                            <h3 class="text-xl font-semibold mb-4">Recent Plot Listings & Your Inquiries</h3>
                            <div class="bg-gray-50 p-4 rounded-lg border border-dashed border-gray-300 text-gray-500">
                                <p>Details of recent plot listings and your inquiries will be displayed here.</p>
                                <ul class="mt-4 space-y-2">
                                    <li class="p-2 bg-white rounded-md border border-gray-200"><a href="{{ route('dashboard', ['viewType' => 'plot', 'id' => 1]) }}" class="text-blue-600 hover:underline">Plot A - New Listing (View Details)</a></li>
                                    <li class="p-2 bg-white rounded-md border border-gray-200">Inquiry for Plot B - Pending (Check Status)</li>
                                    <li class="p-2 bg-white rounded-md border border-gray-200"><a href="{{ route('dashboard', ['viewType' => 'plot', 'id' => 3]) }}" class="text-blue-600 hover:underline">Plot C - Price Updated (View Details)</a></li>
                                    <li class="p-2 bg-white rounded-md border border-gray-200"><a href="{{ route('dashboard', ['viewType' => 'plots']) }}" class="text-blue-600 hover:underline">View All Available Plots</a></li>
                                </ul>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
        </main>
    </div>

</x-dashboard-layout>   