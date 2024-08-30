<template>
    <a-card title="Tai Khoan" style="width: 100%">
        <div class="row mb-3">
            <div class="col-12 d-flex justify-content-end">
                <a-button type="primary">
                    <router-link :to="{ name: 'admin-users-create' }">
                        <PlusOutlined />
                    </router-link>
                </a-button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <a-table
                    :dataSource="users"
                    :columns="columns"
                    :scroll="{ x: 576 }"
                >
                    <template #bodyCell="{ column, index, record }">
                        <template v-if="column.key === 'index'">
                            <span>{{ index + 1 }}</span>
                            <!-- tim den key index va +1 -->
                        </template>

                        <template v-if="column.key === 'status'">
                            <span
                                v-if="record.status_id == 1"
                                class="text-primary"
                                >{{ record.status }}</span
                            >
                            <span
                                v-else-if="record.status_id == 2"
                                class="text-danger"
                                >{{ record.status }}</span
                            >
                            <!-- record la tham chieu den thang key -->
                        </template>

                        <template v-if="column.key === 'action'">
                            <router-link
                                :to="{
                                    name: 'admin-users-edit',
                                    params: { id: record.id },
                                }"
                            >
                                <a-button type="primary" class="me-sm-2 mb-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a-button>
                            </router-link>
                            <a-button
                                type="primary"
                                danger
                                @click="deleteUser(record.id)"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </a-button>
                        </template>
                    </template>
                </a-table>
            </div>
        </div>
    </a-card>
</template>
<script>
import { createVNode, ref } from "vue";
import { useMenu } from "../../../stores/use-menu";
import { PlusOutlined, ExclamationCircleOutlined } from "@ant-design/icons-vue";
import { message } from "ant-design-vue";
import axios from "axios";
import { Modal } from "ant-design-vue";
export default {
    components: {
        PlusOutlined,
    },
    setup() {
        useMenu().onSelectedKeys(["admin-users"]);
        const users = ref([]);
        const columns = [
            {
                title: "#",
                key: "index",
            },
            {
                title: "Avatar",
                dataIndex: "avatar", //truong can lay ra-> lay ra tat ca cac truong ussername bo vao bang
                key: "avatar",
            },
            {
                title: "Tai Khoan",
                dataIndex: "username", //truong can lay ra-> lay ra tat ca cac truong ussername bo vao bang
                key: "username",
            },
            {
                title: "Ho Ten",
                dataIndex: "name", //truong can lay ra-> lay ra tat ca cac truong ussername bo vao bang
                key: "name",
            },
            {
                title: "Phong ban",
                dataIndex: "departments",
                key: "departments",
            },
            {
                title: "Vai Tro",
                dataIndex: "", //truong can lay ra-> lay ra tat ca cac truong ussername bo vao bang
                key: "roles",
            },
            {
                title: "Tinh Trang",
                dataIndex: "status", //truong can lay ra-> lay ra tat ca cac truong ussername bo vao bang
                key: "status",
            },
            {
                title: "Hanh Dong",
                dataIndex: "", //truong can lay ra-> lay ra tat ca cac truong ussername bo vao bang
                key: "action",
                fixed: "right",
            },
        ];
        const getUsers = () => {
            // Make a request for a user with a given ID
            axios
                .get("http://127.0.0.1:8000/api/users")
                .then(function (response) {
                    // handle success
                    console.log(response);
                    users.value = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .finally(function () {
                    // always executed
                });
        };

        const deleteUser = (id) => {
            Modal.confirm({
                title: "Do you want to delete these items?",
                icon: createVNode(ExclamationCircleOutlined),
                content:
                    "When clicked the OK button, this dialog will be closed after 1 second",
                onOk() {
                    axios
                        .delete(`http://127.0.0.1:8000/api/users/${id}`)
                        .then((response) => {
                            
                            if (response.status == 200) {
                                message.success("xoa thanh cong");
                                getUsers();
                            }
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                },
                // eslint-disable-next-line @typescript-eslint/no-empty-function
                cancelText:"Huy",
                onCancel() {
                    Modal.destroyAll();
                },
            });
        };

        // const getUSers_2 = async () => {
        //     try {
        //         const response = await axios.get("http://127.0.0.1:8000/api/users");
        //         console.log(response);
        //     } catch (error) {
        //         console.error(error);
        //     }
        // };
        getUsers();

        return {
            users,
            columns,
            deleteUser,
        };
    },
};
</script>
