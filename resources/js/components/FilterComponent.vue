<template>
    <div class="form-group" >
        <label class="control-label col-lg-2" for="parent_id">فیلتر
        </label>

        <div class="col-lg-10">

            <div>

                <div class="col-lg-5 m-bot15">
                    <input type="text" class="form-control" placeholder="عنوان" name="title" v-model="title">
                </div>

                <div class="col-lg-4 input-group m-bot15" >
                    <select class="form-control m-bot15" name="parent_id" v-model="parent_id">
                        <option selected value="0" >سرگروه</option>

                        <option :value="item.filter_id" v-for="item in parent" >
                            {{ item.title }}
                        </option>

                    </select>
                    <span class="input-group-btn">
                        <span class="btn btn-success" @click="addFilter(title,parent_id)">+</span>
                    </span>
                </div>

            </div>

            <table class="table table-bordered" v-show="Object.keys(filters).length !== 0">
                <thead>
                <tr >
                    <th>عنوان</th>
                    <th>سرگروه</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="filter in filters">
                    <td>{{ filter.title }}</td>
                    <td>{{ filter.parent }}</td>
                    <td>
                        <span class="btn btn-sm btn-danger" @click="deleteFilter(filter.filter_id)">
                            <i class="icon-trash "></i>
                        </span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>

<script>
    export default {
        props:['category_id'],
        data:function(){
            return {
                counts : 1,
                filters : {},
                parent : {},
                title : null,
                parent_id : 0 ,
                /*inputs:[
                    {
                        title : null,
                        parent_id : 0,
                        filter_id : null,
                    },
                ],
                parent:{},*/
            }
        },
        mounted() {
            this.getFilters()
        },

        methods:{
            /*addInput(){
                this.inputs.push({
                    filter_id : null,
                    title : null,
                    parent_id : null,
                });
            },*/

            addFilter(title=null,parent_id=null){

                if (title==null || parent_id==null){
                    return iziToast.show({
                        title: ' کاربر گرامی! ',
                        message: 'فیلد های خالی را پر کنید',
                        rtl: true,
                        color: 'red',
                    });
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    context: this,
                    url : '/admin/filter/add/',
                    method: 'patch',
                    type:'post',
                    dataType:'json',
                    data:{
                        'parent_id' : parent_id,
                        'title' : title,
                        'category_id' : this.category_id,
                    },
                    success(response){
                        console.log(response);
                        this.filters.push({
                            title : response.data.title,
                            parent_id : response.data.parent_id,
                            filter_id : response.data.filter_id,
                            parent : response.data.parent,
                        });
                        if (response.data.parent_id == 0){
                            this.parent.push({
                                title : response.data.title,
                                parent_id : response.data.parent_id,
                                filter_id : response.data.filter_id,
                                parent : response.data.parent,
                            });
                        }

                        iziToast.show({
                            title: ' کاربر گرامی! ',
                            message: response.message,
                            rtl: true,
                            color: 'blue',
                        });
                    },
                });

            },

            getFilters(){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    context: this,
                    url : '/admin/filter',
                    method: 'post',
                    type:'post',
                    dataType:'json',
                    data:{
                        category_id:this.category_id,
                    },
                    success(response){
                        console.log(response);
                        /*response.data.forEach(filter =>
                            this.inputs.push({
                            title : filter.title,
                            parent_id : filter.parent_id,
                            filter_id : filter.filter_id,
                        }));

                        this.parent = response.parent;*/

                        this.filters = response.data;
                        this.parent = response.parent;
                    }
                });


            },

            deleteFilter(filter_id){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    context: this,
                    url : '/admin/filter/delete',
                    method: 'delete',
                    type:'delete',
                    dataType:'json',
                    data:{
                        filter_id:filter_id,
                    },
                    success(response){
                        console.log(response);

                        /*this.inputs.pop({
                            title : response.data.title,
                            parent_id : response.data.parent_id,
                            filter_id : response.data.filter_id,
                        });*/

                        this.getFilters();
                        iziToast.show({
                            title: ' کاربر گرامی! ',
                            message: response.message,
                            rtl: true,
                            color: 'green',
                        });
                    }
                });

            }

        }
    }
</script>
