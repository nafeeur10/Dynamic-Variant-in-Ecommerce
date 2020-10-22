<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create Product
            </h2>
            
        </template>

        <div class="py-12">

            <div class="max-w-7x mx-auto sm:px-6 lg:px-8">
                <div class="flex mb-4">
                    <div class="w-1/2 bg-white shodow mr-4">
                        <form class="w-full p-5">
                            <div class="flex flex-wrap -mx-3 mb-6">
                                <div class="w-full px-3 mb-6">
                                    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-product-name">
                                        Product Name
                                    </label>
                                    <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="Product Name">
                                </div>
                                <div class="w-full px-3 mb-6">
                                    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-product-sku">
                                        Product SKU
                                    </label>
                                    <input class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Product SKU">
                                </div>

                                <div class="w-full px-3">
                                    <label class="block tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-product-description">
                                        Product Description
                                    </label>
                                    <textarea class="appearance-none block w-full bg-white text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" placeholder="Description"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="w-1/2">
                        <div class="w-full rounded overflow-hidden shadow-lg">
                            <div class="bg-gray-200 py-2 px-2">
                                Variants
                            </div> 
                            <div v-if="variantList.length > 0">
                                <div class="px-6 py-4 bg-white" v-for="(variant, index) in variantList" :key="index">
                                    <div class="flex justify-between w-full">
                                        <span>Option</span>
                                        <span>Remove</span>
                                    </div>

                                    <div class="flex">
                                        <select 
                                            @change="onSelectVariant($event)"
                                            name="variant" 
                                            id="variantName" 
                                            class="block appearance-none w-full bg-white border border-gray-200 text-gray-700 py-2 px-4 mr-3 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                        >
                                            <option :value="variantName.id" v-for="variantName in variants" :key="variantName.id">{{ variantName.title }}</option>
                                        </select>
                                        
                                        <multiselect
                                            v-model="secondVariant[index]"
                                            :multiple="true"
                                            @select="mainVariants"
                                            :options="variant_value.options"
                                        ></multiselect>
                                    </div>
                                </div>
                            </div>

                            <button @click="addVariant" class="m-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                                Add Another Variant
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        


        <!-- Second part of Form -->

        <div class="pb-12">

            <div class="max-w-7x mx-auto sm:px-6 lg:px-8">
                <div class="flex mb-4">
                    <div class="w-1/2 mr-4">
                        <div class="w-full rounded overflow-hidden shadow-lg">
                            <div class="bg-gray-200 py-2 px-2">
                                Media
                            </div> 
                            <div class="px-6 py-4 bg-white">
                                <vue2-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue2-dropzone>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'
    import Multiselect from 'vue-multiselect'

    let obj = {};

    export default {
        components: {
            AppLayout,
            vue2Dropzone,
            Multiselect 
        },
        data() {
            return {
                dropzoneOptions: {
                    url: '/store-multiple-image',
                    headers: {
                        "X-CSRF-TOKEN": document.head.querySelector("[name=csrf-token]").content
                    }
                },
                variants: [
                    {id: 1, title: 'Color', options: ['Red', 'Green', 'Blue']},
                    {id: 2, title: 'Size', options: ['XL', 'SM', 'ML']},
                ],
                variantList: [],
                variant_value: null,
                secondVariant: [],
                allVariants: [],
        }
      },
      methods: {
          addVariant() {
              this.variantList.push(this.variants);

              obj = {};

              obj[this.variant_value] = [];

              this.allVariants.push(obj);

            //   if(this.secondVariant.length>0) {

            //   }
            //   else {

            //   }
          },
          mainVariants(selectedOption, id) {

              obj[this.variant_value] = selectedOption;

              this.allVariants.push(obj);

              console.log(obj);

            //   if(this.allVariants.length>0){
            //       this.allVariants[this.allVariants.length].push(selectedOption);
            //   }
            //   else{
            //       this.allVariants[0].push(selectedOption);
            //   }
          },
          onSelectVariant(event) {
            let selected = event.target.value
            let found = this.variants.find( elem => elem.id == selected );
            this.variant_value = found;
          }
      },
      mounted() {
          this.variant_value = this.variants[0];
      }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>