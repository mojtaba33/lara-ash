<template>
    <li class="li_cart">
        <a href="/cart">
            <span class="icon_bag_alt"></span>
            <div class="tip"> {{ totalCount }}</div>
        </a>
        <ul class="cart_items" v-if="cartData != null || totalCount != 0" :class="{'dn':totalCount == 0}">
            <li class="cart_item" v-for="(cart , index) in cartData" :key="`cart-${index}`">
                <div>
                    <img :src="cart.image" alt="" height="64">
                </div>
                <div>
                    <a :href="cart.url">{{ cart.title }}</a>
                </div>
                <div>
                    <span>x {{ cart.count }}</span>
                </div>
                <div>
                    <a href="#" @click.prevent="deleteCart(cart.cart_id)" style="color:red">x</a>
                </div>
            </li>
            <li style="text-align: center;margin-top: 20px;border:2px solid #111;width: 100%;">
                <a href="/checkout">checkout</a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        name: "CartComponent",
        props : ['carts'],
        data(){
            return{
                myCarts : this.carts,
            }
        },
        watch:{
            carts(){
                this.myCarts = this.carts;
            },
        },
        computed: {
            /*carts(){
                this.myCarts = this.carts;
            },*/
            totalCount(){
                if ( this.myCarts == null )
                {
                    return 0;
                }
                return  this.myCarts.totalCount;
            },
            cartData(){
                if ( this.myCarts == null )
                {
                    return null;
                }
                return  this.myCarts.data;
            }
        },
        created(){
            this.getCarts();
            console.log(this.getCarts())
        },
        methods:{
            deleteCart(id)
            {
                let obj = this;
                axios
                    .delete('/cart/delete',{
                        params: { id : id }
                    })
                    .then(function (response) {
                        /*console.log(response.data);
                        iziToast.show({
                            title: 'success',
                            message: 'done!',
                            rtl: false,
                            color: 'green',
                        });*/
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
                        obj.myCarts = response.data;
                        console.log(response.data);
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
        }
    }

</script>

<style scoped>
    .cart_item{
        align-items: center;
        justify-content: space-between;
    }
    .cart_item a ,.cart_item span{
        font-size: 12px;
        color: #777;
        font-weight: 100;
    }
    .dn{
        visibility: hidden !important;
    }
</style>
