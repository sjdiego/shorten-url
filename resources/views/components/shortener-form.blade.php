<div class="flex items-center justify-center px-5 py-5">
    <div class="w-full mx-auto rounded-lg bg-white shadow p-5 text-gray-800" style="max-width: 500px">
        <div class="relative mb-2">
            <label class="block text-xs font-semibold text-gray-500 mb-2">URL</label>
            <input id="url" placeholder="https://www.google.com" autocomplete="off" class="w-full pl-3 pr-10 py-2 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors">
        </div>
        
        <div class="mb-2 flex flex-row justify-between">
            @include('components.toggle')
            @include('components.button')
        </div>
        
        <hr class="my-5 border border-gray-200">
        
        <div class="mb-2">
            <label class="block text-xs font-semibold text-gray-500 mb-2">MAX VISITS</label>
            <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="Length" type="number" min="1" max="30" step="1" x-model="charsLength" @input="generatePassword()"/>
        </div>

        <div class="mb-2">
            <label class="block text-xs font-semibold text-gray-500 mb-2">EXPIRE DATE</label>
            <input class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="Length" type="number" min="1" max="30" step="1" x-model="charsLength" @input="generatePassword()"/>
        </div>
    </div>
</div>