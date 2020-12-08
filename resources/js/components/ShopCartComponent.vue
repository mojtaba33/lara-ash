<template>
    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container" v-if="cartData != null">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table >
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Color</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(cart,index) in cartData">
                                <td class="cart__product__item">
                                    <img src="img/shop-cart/cp-1.jpg" alt="">
                                    <div class="cart__product__item__title">
                                        <h6><a :href="cart.url" style="color: #000;">{{ cart.title }}</a></h6>
                                    </div>
                                </td>
                                <td class="cart__total">{{ cart.size.substring(cart.size.indexOf("'") + 1,cart.size.lastIndexOf("'")) }}</td>
                                <td class="cart__total">
                                    <span class="color" :style="{ backgroundColor: cart.color }"></span>
                                </td>
                                <td class="cart__price">$ {{ cart.product_price }}</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty" style="position: relative">
                                        <span @click="updateCart(cart.cart_id , -1 )" class="decrease">-</span>
                                        <input type="text" :value="cart.count" disabled style="background-color: inherit;width: 100%; ">
                                        <span @click="updateCart(cart.cart_id , 1 )" class="increase">+</span>
                                    </div>
                                </td>
                                <td class="cart__total">$ {{ cart.price }}</td>
                                <td class="cart__close">
                                    <span class="icon_close" @click="deleteCart(cart.cart_id)"></span>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="/checkout">Continue Shopping</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn update__btn">
                        <a href="#"><span class="icon_loading"></span> Update cart</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>$ {{ totalPrice }}</span></li>
                            <li>Total <span>$ {{ totalPrice }}</span></li>
                        </ul>
                        <a href="/checkout" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
        <div v-else style="text-align: center;margin: 20px auto;">
            your cart is empty
        </div>
    </section>
    <!-- Shop Cart Section End -->
</template>

<script>
    export default {
        name: "ShopCartComponent",
        data(){
            return{
                myCarts : null,
                count   : 1 ,
            }
        },
        computed: {
            totalCount(){
                if ( this.myCarts == null )
                {
                    return 0;
                }
                return  this.myCarts.totalCount;
            },
            totalPrice(){
                if ( this.myCarts == null )
                {
                    return 0;
                }
                return  this.myCarts.totalPrice;
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
        },
        methods:{
            deleteCart(id)
            {
                let obj = this;
                axios
                    .delete('/cart/delete',{
                        params: { id : id }
                    })
                    .then(function () {
                        obj.getCarts();
                    })
                    .catch(function (error) {
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
                    })
                    .catch(function (error) {
                        iziToast.show({
                            title: 'error',
                            message: 'something went wrong!',
                            rtl: false,
                            color: 'red',
                        });
                    });
            },
            updateCart(id,count)
            {
                let obj = this;
                axios
                    .put('/cart/update',{
                        params: { id : id , count : count }
                    })
                    .then(function (response) {
                        if(response.data.message)
                        {
                            iziToast.show({
                                title: response.data.title,
                                message: response.data.message,
                                rtl: false,
                                color: response.data.color,
                            });
                        }
                        obj.getCarts();
                    })
                    .catch(function (error) {
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
    .color{
        width: 20px;
        height: 20px;
        display: block;
        border-radius: 50%;
        margin: 0 20%;
    }
</style>