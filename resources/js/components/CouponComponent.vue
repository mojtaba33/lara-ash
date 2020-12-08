<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="discount__content p-5">
                <h6>Discount codes</h6>
                <form>
                    <input type="text" v-model="code" placeholder="Enter your coupon code">
                    <button @click.prevent="checkCoupon()" class="site-btn">Apply</button>
                    <div style="text-align: center;" v-if="success.show">
                        <ul class="list-group" style="margin:20px 0">
                            <li class="list-group-item text-success">{{success.message}}</li>
                            <li class="list-group-item">old price : {{success.oldPrice}} $</li>
                            <li class="list-group-item">new price : {{success.newPrice}} $</li>
                        </ul>
                        <form action="/payment/Zarinpal" method="post">
                            <input type="hidden" name="_token" :value="csrf">
                            <button type="submit" class="site-btn" style="position:unset !important;">Place oder</button>
                        </form>
                    </div>
                    <div style="text-align: center;" v-if="error.show">
                        <p class="text-warning" style="margin:20px 0">
                            {{error.message}}
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "",
        props : [],
        data: () => ({
             code : '',
             show : false,
             success : {
                 show : false ,message : '', oldPrice :'' ,newPrice : ''
             },
             error : {show : false ,message : ''}
        }),
        computed:{
            csrf(){
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            }
        },
        methods: {
            checkCoupon() {
                let obj = this;
                axios
                    .post('/check-coupon', {
                        code: this.code
                    })
                    .then(function (response) {
                        if (response.data.message) {
                            obj.error.show = false;
                            obj.success.show = true;
                            obj.success.message = response.data.message;
                            obj.success.oldPrice = response.data.oldPrice;
                            obj.success.newPrice = response.data.newPrice;
                        }

                    })
                    .catch(function (error) {
                        obj.success.show = false;
                        obj.error.show = true;
                        obj.error.message = error.response.data.message;
                    });
            },
        }

    }
</script>

<style scoped>

</style>