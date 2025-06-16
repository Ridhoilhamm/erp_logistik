<div>
    <form wire:submit.prevent="store">
        <h3 class="text-2xl font-semibold text-gray-700 mb-4">Create Product Category</h3>
        <input wire:model="name" type="text"
            class="w-full px-4 py-2 mb-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Nama kategori">
        <button type="submit"
            class="w-full py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700">
            Create
        </button>
    </form>
</div>
