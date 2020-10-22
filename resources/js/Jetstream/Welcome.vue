<template>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Products</h2>
            </div>
            <div class="mt-2 p-3 shadow flex sm:flex-row flex-col bg-gray-200">
                <div class="flex mb-1 sm:mb-0 justify-between w-full">
                    <div class="relative">
                        <div>
                            <input 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                                id="product_title" 
                                type="text" 
                                placeholder="Product Title"
                                v-model="searchTitle"
                            >
                        </div>
                    </div>

                    <div class="relative">
                        <select-component 
                          :options="variantList"
                          v-model="searchVariant"
                        >
                        </select-component>
                    </div>

                    <div>
                        <div class="inline-flex">
                            <span class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                                Price Range
                            </span>
                            <input class="appearance-none border border-r-none py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="product_price_range_from" type="text" placeholder="From">
                            <input class="appearance-none border py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="product_price_range_to" type="text" placeholder="To">
                        </div>
                    </div>

                    <div class="calendar">
                        <input type="date" id="table_date_picker" class="py-1 h-full px-3" name="Table Date Picker">
                    </div>

                    <div class="block relative">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-3 rounded">
                           <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-white">
                                <path
                                    d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                </path>
                            </svg>
                        </button>
                        <div class="hidden">
                            <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                    <path
                                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                    </path>
                                </svg>
                            </span>
                            <input placeholder="Search"
                                class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                        </div>
                    </div>
                </div>

            </div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 pb-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow bg-white overflow-hidden mt-2">
                    <table class="min-w-full leading-normal table-fixed">
                        <thead>
                            <tr>
                                <th
                                    class="w-1/24 px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    #
                                </th>
                                <th
                                    class="w-1/12 px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Title
                                </th>
                                <th
                                    class="w-1/2 px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Description
                                </th>
                                <th
                                    class="w-1/2 px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Variant
                                </th>
                                <th
                                    class="w-1/12 px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in queryResults" :key="product.id">
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    {{ product.id }}
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900">{{ product.title }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-gray-900">
                                        {{ product.description }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white">
                                    <div class="flex" v-for="variant in product.variants.slice(0, 2)" :key="variant.id">
                                        <div class="flex-0 text-gray-700 text-center m-2"><span><b>{{ variant.color }}</b> / <b>{{ variant.size }} / </b></span></div>
                                        <div class="flex-1 text-gray-700 text-center m-2"><span><b>Price: {{ variant.price }}</b></span></div>
                                        <div class="flex-1 text-gray-700 text-center m-2"><span>InStock: {{ variant.inStock }}</span></div>
                                    </div>

                                   <div class="flex">
                                        <div class="flex-0 text-gray-700 text-center m-2"><a href="javascript:void(0)">Show More</a></div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div
                        class="px-5 py-5 bg-white border-t flex flex-row items-center xs:justify-between">
                        <span class="text-xs xs:text-sm text-gray-900">
                            Showing 1 to 4 of 50 Entries
                        </span>
                        <div class="inline-flex mt-2 xs:mt-0 ml-auto">
                            <button
                                class="text-sm bg-white hover:bg-blue-600 text-blue-800 hover:text-white border font-semibold py-2 px-4 rounded-l">
                                <span>
                                    <svg style="width: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fillRule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clipRule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                            <button
                                class="text-sm bg-blue-500 hover:bg-blue-600 text-white border font-semibold py-2 px-4">
                                1
                            </button>
                            <button
                                class="text-sm bg-white hover:bg-blue-600 text-blue-800 hover:text-white border font-semibold py-2 px-4">
                                2
                            </button>
                            <button
                                class="text-sm bg-white hover:bg-blue-600 text-blue-800 hover:text-white font-semibold border py-2 px-4">
                                3
                            </button>
                            <button
                                class="text-sm bg-white hover:bg-blue-600 text-blue-800 hover:text-white font-semibold border py-2 px-4">
                                4
                            </button>
                            <button
                                class="text-sm bg-white hover:bg-blue-600 text-blue-800 hover:text-white font-semibold border py-2 px-4 rounded-r">
                                <span>
                                    <svg style="width: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fillRule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clipRule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            searchTitle: null,
            searchVariant: null,
            variantList: ['red', 'green', 'blue'],
            products: [
                {
                    id: 1, 
                    title: 'Horem, ipsum dolor sit amet consectetur adipisicing elit.',
                    description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda repellat fugiat ea corporis, illo, eveniet id quas perspiciatis deserunt a molestiae minus, in ratione mollitia unde! Vero fugiat ipsa deleniti.',
                    variants: [
                        {id: 1, color: 'red', size: 'xl', price: 150, inStock: 150},
                        {id: 2, color: 'blue', size: 'xl', price: 46, inStock: 4},
                        {id: 3, color: 'gray', size: 'sm', price: 50, inStock: 50}
                    ]
                },
                {
                    id: 2, 
                    title: 'Lorem, ipsum dolor sit amet consectetur adipisicing elit.',
                    description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda repellat fugiat ea corporis, illo, eveniet id quas perspiciatis deserunt a molestiae minus, in ratione mollitia unde! Vero fugiat ipsa deleniti.',
                    variants: [
                        {id: 1, color: 'red', size: 'xl', price: 150, inStock: 150},
                        {id: 2, color: 'blue', size: 'xl', price: 46, inStock: 4},
                        {id: 3, color: 'green', size: 'sm', price: 50, inStock: 50}
                    ]
                }
            ]
        }
        },
    computed: {
        queryResults() {
            if(this.searchTitle){
                return this.products.filter((item)=>{
                    return this.searchTitle.toLowerCase().split(' ').every(v => item.title.toLowerCase().includes(v))
                })
            }
            else if(this.searchVariant) {
                const searchv = this.searchVariant;
                return this.products.filter(item =>
                    item.variants.some(variant => searchv.toLowerCase().includes(variant.color)
                ));
            }
            else{
                return this.products;
            }
        }
    }
}
</script>
<style>
select {
  width: 100px;
}

.select2-selection__arrow {
    margin-top: 5px;
}

.selection .select2-selection--single {
    height: 38px;
    padding-top: 3px;
}
</style>
