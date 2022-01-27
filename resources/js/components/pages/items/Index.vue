<template>
    <div>

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Items </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><router-link :to="{name: 'home'}">Dashboard</router-link></li>
                            <li class="breadcrumb-item active">Items </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>










        <div class="card">
            <div class="card-header">
                <h3 style="display: inline" class="card-title">Data Table With Full Features</h3>
                <button type="button" class="btn btn-info clickable-2"
                        data-toggle="modal" data-target="#form-2"
                        style="float: right"
                        @click="errors['name'] = null"
                >
                    Create new item
                </button>



                <span style="clear: both;"></span>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">

                    <div class="row justify-content-end"><div class="col-sm-12">

                        <span>Show Entries: </span>
                        <select name="entries" @change="changeLimit($event)" id="" style="width: 20%;">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>

                        <div style="display: inline; float: right;">
                            <span>Search: </span>
                            <input type="text" @keyup="findProduct($event)">
                        </div>
                        <span style="clear: both;"></span>




                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">



                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 161.203px;">
                                    #ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1"
                                    rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                                    style="width: 212.859px;">
                                    Name
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1"
                                    rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                    style="width: 197.25px;">
                                    Model
                                </th>


                                <th class="sorting" tabindex="0" aria-controls="example1"
                                    rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                                    style="width: 197.25px;">
                                    Brand
                                </th>





                                <th  class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                          aria-label="CSS grade: activate to sort column ascending"
                                          style="width: 94.3906px;">Actions</th></tr>
                            </thead>
                            <tbody>

























































                            <tr role="row" class="even" v-for="(item, ind) in theLaravelData.data" :key="item.id">
                                <td class="sorting_1">{{item.id}}</td>
                                <td class="sorting_1">{{item.name | shortName}}</td>
                                <td>{{item.model.name}}</td>
                                <td>{{item.brand.name}}</td>

                                <td width="15%">

                                        <button type="button" class="btn btn-warning clickable"
                                                data-toggle="modal" data-target="#form"
                                        @click="editable(ind)"
                                        >
                                            edit
                                        </button>

                                    <button @click="deleteUser(item.id)" class="btn btn-sm btn-danger" style="font-size: 75%;" >Delete</button>
                                </td>

                            </tr>



                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div></div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <!--<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">-->
                            <!--Showing 1 to 10 of 57 entries-->
                            <!--</div>-->
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                <div style="float: right;">
                                    <pagination :data="laravelData" @pagination-change-page="getResults">
                                    </pagination>

                                </div>
                                <span style="clear: both;"></span>

                            </div></div></div>

                </div>
            </div>
            <!-- /.card-body -->
        </div>







        <!--MODEL-->
        <div class="modal fade fader" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateItem($event)">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="name"  class="form-control"
                                       @keypress="removeError(this)"
                                       :class="{'is-invalid': errors.name}"
                                       id="name" aria-describedby="emailHelp" :value="_edit.name">
                                <small id="emailHelp" class="form-text text-muted invalid-feedback">
                                    <span style="color: red;">
                                        {{errors.name}}

                                    </span>
                                    .</small>
                            </div>
                            <div class="form-group">
                                <label for="model">Model</label>
                                <select name=""  class="form-control" id="model">


                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <select name="" id="brand" class="form-control" v-if="_edit.brand">
                                    <option value=""
                                            :key="brand.id"
                                            :selected="brand.name === _edit.brand.name"
                                            :value="brand.id"
                                            v-for="(brand, index) in _modelsAndBrands.brands">
                                        {{brand.name}}
                                    </option>

                                </select>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>





        <!--MODEL 2ND-->
        <div class="modal fade fader" id="form-2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="storeItem($event)">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name-2">Name</label>
                                <input type="name" @keypress="removeError(this)" class="form-control " :class="{'is-invalid': errors.name}" id="name-2" aria-describedby="emailHelp">
                                <small  class="form-text invalid-feedback text-muted" >
                                    <span style="color: red;">
                                    {{errors.name}}.
                                </span>
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="model-2">Model</label>
                                <select name="" id="model-2" class="form-control">
                                    <option
                                            :key="brand.id"

                                            :value="brand.id"
                                            v-for="(brand, index) in _modelsAndBrands.models">
                                        {{brand.name}}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand-2">Brand</label>
                                <select name="" id="brand-2" class="form-control">
                                    <option
                                            :key="brand.id"

                                            :value="brand.id"
                                            v-for="(brand, index) in _modelsAndBrands.brands">
                                        {{brand.name}}
                                    </option>

                                </select>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>















    </div>
</template>

<script>
    export default {
        data() {
            return {
                laravelData: {},
                limit: 10,
                finder: '',
                edit: {},
                modelsAndBrands: {},
                errors: {},


            }
        },
        computed: {
            _errors() {
              return this.errors;
            },
            _modelsAndBrands() {
                return this.modelsAndBrands;

            },
            _edit() {
              return this.edit;
            },
            theLaravelData() {

                return this.laravelData;
            },





        },
        watch: {
            limit(newVal, oldVal) {

                this.getResults();





            },
        },
        created() {
            axios({
                    method: 'get',
                    url: "/api/items/1/edit",
                    headers: {
                        "authorization": "Bearer "+localStorage.getItem('token'),
                    },}).
                then(res => {
               this.modelsAndBrands = res.data;
            });

        },
        mounted() {

            this.getResults();





        },
        methods: {
            removeError(o) {
                this.errors['name'] = null;

            },



            updateItem(o) {
                const form = o.target;

                const brand = document.getElementById('brand');
                const model = document.getElementById('model');



                let selectedBrand = 0;
                for(let i=0; i<brand.options.length; i++) {
                    if(brand.options[i].selected) {
                        selectedBrand = brand.options[i].value;
                    }

                }




                let selectedModel = 0;
                for(let i=0; i<model.options.length; i++) {
                    if(model.options[i].selected) {
                        selectedModel = brand.options[i].value;
                    }

                }






















                axios({
                    method: 'put',
                    url: `/api/items/${this._edit.id}`,
                    headers: {
                        "authorization": "Bearer "+localStorage.getItem('token'),
                    },
                    data: {
                      name: form[0].value,
                        model_id: selectedModel,
                        brand_id: selectedBrand,



                    },
                }).
                    then(res => {

                    if(res.data.errors) {
                        this.errors = res.data.errors;
                        return;
                    }




                   if(res.data === 1) {
                       document.getElementsByClassName('clickable')[0].click();
                       this.getResults();




                   }
                });




            },
            storeItem(o) {


                const form = o.target;

                const brand = document.getElementById('brand-2');
                const model = document.getElementById('model-2');



                let selectedBrand = 0;
                for(let i=0; i<brand.options.length; i++) {
                    if(brand.options[i].selected) {
                        selectedBrand = brand.options[i].value;
                    }

                }




                let selectedModel = 0;
                for(let i=0; i<model.options.length; i++) {
                    if(model.options[i].selected) {
                        selectedModel = brand.options[i].value;
                    }

                }






















                axios({
                    method: 'post',
                    url: `/api/items`,
                    headers: {
                        "authorization": "Bearer "+localStorage.getItem('token'),
                    },
                    data: {
                        name: form[0].value,
                        model_id: selectedModel,
                        brand_id: selectedBrand,



                    },
                }).
                then(res => {

                    if(res.data.errors) {
                        this.errors = res.data.errors;
                        return;
                    }



                    if(res.data === 1) {
                        document.getElementsByClassName('clickable-2')[0].click();
                        this.getResults();
                        form[0].value = "";




                    }
                });




            },

            editable(i) {
                this.errors['name'] = null;


                const models = document.getElementById("model");
                const brands = document.getElementById("brand");

                this.edit = this.theLaravelData.data[i];


                let m = ``;
                for(let i=0; i<this._modelsAndBrands.models.length; i++) {

                    if(this._modelsAndBrands.models[i].name === this._edit.model.name) {
                        m +=
                            "<option selected " + `value="${this._modelsAndBrands.models[i].id}">` + this._modelsAndBrands.models[i].name + "</option>";



                    } else {
                        m +=
                            "<option " + `value="${this._modelsAndBrands.models[i].id}">` + this._modelsAndBrands.models[i].name + "</option>";
                    }









                }
                
                 if(models)
                models.innerHTML = m;

























































            },





            deleteUser(id) {
                let p = confirm("Are you sure?");

                if(p) {


                    axios({
                        method: 'delete',
                        url: '/api/items/' + id,
                        headers: {
                            'authorization': "Bearer " + localStorage.getItem('token'),
                        }
                    })
                        .then(res => {


                            if (res.data === 1) {
                                this.getResults();


                            }
                        });


                }
            },




            getResults(page = 1) {
                axios({
                    method: 'get',
                    url: '/api/items?page='+page+"&limit="+this.limit+"&search="+this.finder,
                    headers: {
                        'authorization': "Bearer "+localStorage.getItem('token'),
                    }
                })
                    .then(response => {






                        this.laravelData = response.data;
                    });
            },
            changeLimit(ev) {
                this.limit = ev.target.value;

            },
            findProduct(ev) {
                this.finder = ev.target.value;
                this.getResults();
            },
        },
        filters: {
            shortName(val) {
                return val.substring(0, 10);
            }
        },
    }
</script>
<style scoped>
    $grey: #F5F5F5;
    $dark-grey: #323B40;

    $light-blue: #E0F5FF;
    $blue: #B9E5FE;
    $dark-blue: #00A5FA;

    $green: #B7E0DC;
    $dark-green: #019888;

    $lime: #C7E8C8;
    $dark-lime: #42B045;

    $yellow: #FFEEBA;
    $dark-yellow: #FF9901;

    $pink: #FABAD0;
    $dark-pink: #EF075F;

    $red: #FEC9C6;
    $dark-red: #FD3D08;

    @mixin color-div($color1, $color2){
        background-color: $color1;
        color: $color2;
    }

    .container {
        padding: 2rem 0rem;
    }

    h4 {
        margin: 2rem 0rem;
    }

    .panel {
        border-radius: 4px;
        padding: 1rem;
        margin-top: 0.2rem;

    @include color-div($grey, $dark-grey);

    &.panel-blue {
     @include color-div($light-blue, $dark-blue);
     }

    &.panel-big-height{
         min-height: 150px;
     }
    }

    .item {
        border-radius: 4px;
        padding: 0.5rem;
        margin: 0.2rem;

    &.item-blue {
     @include color-div($blue, $dark-blue);
     }

    &.item-green {
     @include color-div($green, $dark-green);
     }

    &.item-lime {
     @include color-div($lime, $dark-lime);
     }

    &.item-yellow {
     @include color-div($yellow, $dark-yellow);
     }

    &.item-pink {
     @include color-div($pink, $dark-pink);
     }

    &.item-red {
     @include color-div($red, $dark-red);
     }

    &.item-big-width{
         min-width: 380px;
     }
    }
</style>