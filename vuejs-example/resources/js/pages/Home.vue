<template>
    <div class="container" style="background: #f3f5f2;height: 100vh;">
        <div class="row m-0 p-0 pt-4">
            <div class="col-6 px-2" v-for="product in products">
                <div class="px-2 pb-2 pt-3 bg-white w-100 mb-3" style="border-radius: 15px;">
                    <img :src="`/images/${product.image}`" style="height: 90px;object-fit: cover;width: 100%;">
                    <p class="text-center mt-2 mb-0" style="font-weight: 500;font-size: 110%;">{{product.name}}</p>
                    <p class="text-center mt-1 mb-0" style="font-weight: 400;font-size: 110%;">${{product.price}}/kg</p>
                    <button class="btn btn-success mt-2" style="width: 100%;border-radius: 12px;"><i class="fa fa-shopping-bag mr-2" aria-hidden="true"></i>Add to cart</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            products: {
                default: []
            }
        },
        created: function () {
            console.log(this.products)
        }
    }
</script>
<style>
::-webkit-scrollbar {
  width: 5px;
}
::-webkit-scrollbar-track {
  background: #f1f1f1;
}
::-webkit-scrollbar-thumb {
  background: #2db467;
}
</style>
