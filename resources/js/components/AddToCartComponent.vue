<template>
    <div>
        <div class="product__details__button">
            <div class="quantity">
                <span>Quantity:</span>
                <div class="pro-qty" style="position: relative">
                    <span @click="count > 1 ? count-- : count=1 " class="decrease">-</span>
                    <input type="text" value="1" v-model="count" disabled>
                    <span @click="count++" class="increase">+</span>
                </div>
            </div>
            <a  href="" class="cart-btn" @click.prevent="addToCart()"><span class="icon_bag_alt"></span> Add to cart</a>
            <ul>
                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
            </ul>
        </div>
        <div class="product__details__widget">
            <ul>
                <li>
                    <span>Availability:</span>
                    <div class="stock__checkbox">
                        <label for="stockin">
                            In Stock
                            <input type="checkbox" id="stockin">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </li>
                <li>
                    <span>Available color:</span>

                    <div class="color__checkbox">
                        <label v-for="(color,index) in colors" :for="color" v-show="color != '' ">
                            <input type="radio" name="color" :value="color" :id="color" v-model="colorChecked">
                            <span class="checkmark" :style="{ backgroundColor: color }"></span>
                        </label>
                    </div>

                </li>
                <li>
                    <span>Available size:</span>
                    <div class="size__btn">
                        <label v-for="(size,i) in sizes" :for="size" :class="{'active': size == sizeChecked}">
                            <input type="radio" name="size" :value="size" :id="size" v-model="sizeChecked">
                            {{ size.substring(size.indexOf("'") + 1,size.lastIndexOf("'")) }}
                        </label>
                    </div>
                </li>
                <li>
                    <span>Promotions:</span>
                    <p>Free shipping</p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: "AddToCartComponent",
        props : ['product_id','url','colors','sizes'],
        data(){
            return {
                count        : 1,
                colorChecked : null,
                sizeChecked  : null,
            }
        },
        watch:{
            count:function(){
                if(this.count < 1)
                {
                    this.count = 1;
                }
            }
        },
        methods:{
            addToCart(){
                let obj = this;
                axios
                    .post( this.url , {
                    product_id : this.product_id,
                    count      : this.count,
                    color      : this.colorChecked,
                    size       : this.sizeChecked,
                    })
                    .then(function (response) {
                        console.log(response);
                        iziToast.show({
                            title: response.data.title,
                            message: response.data.message,
                            rtl: false,
                            color: response.data.color,
                        });
                        obj.getCarts();
                    })
                    .catch(function (error) {
                        console.log(error);
                        iziToast.show({
                            title: 'error',
                            message: 'something went wrong!',
                            rtl: false,
                            color: 'red',
                        });
                    });
            },
            getCarts(){
                let obj = this;
                axios
                    .get('/cart/get')
                    .then(function (response) {
                        console.log(response.data);
                        obj.$root.$emit('getcartevent',response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                        iziToast.show({
                            title: 'error',
                            message: 'something went wrong!',
                            rtl: false,
                            color: 'red',
                        });
                    });
            }
        },

    }
</script>

<style scoped>
.increase{
    position: absolute;
    right: 15px;
    top: 13px;
    cursor:pointer;
}
.decrease{
    position: absolute;
    left: 15px;
    top: 13px;
    cursor:pointer;
}
</style>