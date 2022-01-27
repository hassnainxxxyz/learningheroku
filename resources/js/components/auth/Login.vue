<template>
    <div class="login-box">
        <div class="login-logo">
            <span><b>Test</b>Project</span>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form @submit.prevent="apiCall" @keydown="removeError($event)" action="../../index2.html" method="post">
                    <div class="form-group has-feedback">
                        <input
                                id="email" v-model="form.email"
                                :class="{'is-invalid': errors.email}"
                                type="email" class="form-control" placeholder="Email">
                        <small  class="invalid-feedback">
                            {{errors.email}}.
                        </small>

                    </div>
                    <div class="form-group has-feedback">
                        <input
                                v-model="form.password" id="password"
                                :class="{'is-invalid': errors.password}"
                                type="password" class="form-control" placeholder="Password">
                        <small  class="invalid-feedback">
                            {{errors.password}}.
                        </small>

                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!--<div class="social-auth-links text-center mb-3">-->
                    <!--<p>- OR -</p>-->
                    <!--<a href="#" class="btn btn-block btn-primary">-->
                        <!--<i class="fa fa-facebook mr-2"></i> Sign in using Facebook-->
                    <!--</a>-->
                    <!--<a href="#" class="btn btn-block btn-danger">-->
                        <!--<i class="fa fa-google-plus mr-2"></i> Sign in using Google+-->
                    <!--</a>-->
                <!--</div>-->
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <!--<a href="#">I forgot my password</a>-->
                </p>
                <p class="mb-0">
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

</template>


<script>
    let body = document.body;
    export default {
        beforeCreate() {

          body.classList.add('hold-transition', 'login-page');
        },
        data() {
            return {
                form: {
                    email: '',
                    password: '',
                },
                errors: {},


            };
        },
        methods: {

            removeError(obj) {
                this.errors[obj.target.id] = null;
            },
            apiCall() {
                axios({
                    method: 'post',
                    url: '/api/login',
                    data: this.form,
                })
                    .then(res => {


                        if(res.data.errors) {
                            this.errors = res.data.errors;

                        } else if(res.data.data) {
                            let data = res.data.data;



                                localStorage.setItem('token', data.token);

                                localStorage.setItem('user', JSON.stringify(data.user));


                                 this.$router.push({name: 'home'});



















                        }
                    })
                    .catch(err => {
                        console.log(err);
                    });
            },

        },


        beforeDestroy() {
            body.classList.remove('hold-transition', 'login-page');
        },

    }
</script>

