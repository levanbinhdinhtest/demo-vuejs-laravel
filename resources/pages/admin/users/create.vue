<template>
    <form action="" @submit.prevent="createUSers()">
        <a-card title="Create new Account" style="width: 100%">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <a-avatar shape="square" :size="200">
                                <template #icon>
                                    <img
                                        src="../../../assets/pts12.jpg"
                                        alt=""
                                    />
                                </template>
                            </a-avatar>
                        </div>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <a-button type="primary mt-3"> Choose Image </a-button>
                    </div>
                </div>
                <div class="col-12 col-sm-8">
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label for="">
                                <span class="text-danger me-1">*</span>
                                <span 
                                :class="{
                                    'text-danger': errors.status_id
                                }"
                                >Tinh trang</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-select
                                show-search
                                placeholder="Tinh Trang"
                                style="width: 100%"
                                :options="users_status"
                                :filter-option="filterOption"
                                v-model:value="status_id"

                            ></a-select>
                            <div class="w-100"></div>
                            <small v-if="errors.status_id">{{ errors.status_id[0] }}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label for="">
                                <span class="text-danger me-1">*</span>
                                <span 
                                :class="{
                                    'text-danger': errors.username
                                }" >Ten Tai Khoan</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input placeholder="Ten Tai Khoan"
                             allow-clear
                             v-model:value="username" />

                             <div class="w-100"></div>
                            <small v-if="errors.username">{{ errors.username[0] }}</small>
                        </div>
                        
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label for="">
                                <span class="text-danger me-1">*</span>
                                <span :class="{
                                    'text-danger': errors.name
                                }">Ho Va Ten</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input placeholder="Ho Va Ten"
                             allow-clear
                             v-model:value="name" />

                             <div class="w-100"></div>
                             <small v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                     
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label for="">
                                <span class="text-danger me-1">*</span>
                                <span :class="{
                                    'text-danger': errors.email
                                }">Email</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input placeholder="Email"
                             allow-clear
                             v-model:value="email" />

                             <div class="w-100"></div>
                             <small v-if="errors.email">{{ errors.email[0] }}</small>
                        </div>
                      
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label for="">
                                <span class="text-danger me-1">*</span>
                                <span :class="{
                                    'text-danger': errors.department_id
                                }">Phong ban</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-select
                                show-search
                                placeholder="Phong ban"
                                style="width: 100%"
                                :options="departments"
                                :filter-option="filterOption"
                                v-model:value="department_id"
                            ></a-select>

                            <div class="w-100"></div>
                            <small v-if="errors.department_id">{{ errors.department_id[0] }}</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label for="">
                                <span class="text-danger me-1">*</span>
                                <span :class="{
                                    'text-danger': errors.password
                                }">Mat Khau</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input-password
                             placeholder="input password"
                             v-model:value="password" />

                             <div class="w-100"></div>
                            <small v-if="errors.password">{{ errors.password[0] }}</small>
                        </div>
                        
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-3 text-start text-sm-end">
                            <label for="">
                                <span class="text-danger me-1">*</span>
                                <span>Xac Nhan Mat Khau</span>
                            </label>
                        </div>
                        <div class="col-12 col-sm-5">
                            <a-input-password
                             placeholder="Xac Nhan Mat Khau"
                             v-model:value="password_confirmation" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div
                    class="col-12 d-grid mx-auto d-sm-flex justify-content-sm-end"
                >
                    <a-button class="me-sm-2 mb-3 mb-sm-0">
                        <router-link :to="{ name: 'admin-users' }">
                            <span>Huy</span>
                        </router-link>
                    </a-button>
                    <a-button type="primary" class="" html-type="submit">
                        <span>Luu</span>
                    </a-button>
                </div>
            </div>
        </a-card>
    </form>
</template>

<script>
import { reactive, ref, toRefs } from "vue";
import { useMenu } from "../../../stores/use-menu";
import { message } from 'ant-design-vue';
import { useRouter } from "vue-router";
import axios from "axios";
export default {
    setup() {
        const router = useRouter();
        useMenu().onSelectedKeys(["admin-users"]);
        const users_status = ref([]);
        const departments = ref([]);
        const users = reactive({
            username: "",
            name: "",
            email:"",
            password:"",
            password_confirmation:"",
            department_id:[],
            status_id:[]
        });
        //hứng các lỗi được khia báo trong usercontroller
        const errors = ref({});
        const getUsersCreate = () => {
            axios
                .get("http://127.0.0.1:8000/api/users/create")
                .then((responsive) => {
                    users_status.value = responsive.data.users_status;
                    departments.value = responsive.data.departments;
                })
                .catch((error) => {
                    console.log(error);
                });
        };
        const filterOption = (input, option) => {
            return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
        };
        const createUSers = () => {
            axios.post("http://127.0.0.1:8000/api/users",users)
            .then((responsive)=>{
                if(response.status==200){
                    message.success('This is a success message');
                    router.push({name:"admin-users"});
                }
            })
            .catch((error)=>{
                errors.value = error.response.data.errors;
            })
        };

        getUsersCreate();
        return {
            users_status,
            departments,
            filterOption,
            createUSers,
            ...toRefs(users),
            errors
        };
    },
};
</script>

<style></style>
