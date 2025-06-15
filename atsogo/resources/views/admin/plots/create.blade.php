<x-dashboard-layout>
    <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Create New Plot (Admin)</h2>
    <div class="p-6 rounded-xl shadow-lg">
        <form action="{{ route('admin.plots.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                <input type="text" name="title" id="title" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">
            </div>
            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                <input type="number" name="price" id="price" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">
            </div>
            <div class="mb-4">
                <label for="area_sqm" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Area (sqm)</label>
                <input type="number" name="area_sqm" id="area_sqm" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">
            </div>
            <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                <input type="text" name="location" id="location" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                <select name="status" id="status" required class="mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400">
                    <option value="available">Available</option>
                    <option value="sold">Sold</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="is_new_listing" class="flex items-center">
                    <input type="checkbox" name="is_new_listing" id="is_new_listing" class="mr-2">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">New Listing</span>
                </label>
            </div>
            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Create Plot</button>
            </div>
        </form>
    </div>
</x-dashboard-layout>