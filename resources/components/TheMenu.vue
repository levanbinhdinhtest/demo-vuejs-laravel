<template>
     <a-menu
      v-model:openKeys="openKeys"
      v-model:selectedKeys="selectedKeys"
      mode="inline"
    >
            <a-menu-item  v-for="item in items" :key="item.key" >
                <router-link :to="{name: item.name}">
                    <component :is="item.icon" class="me-1"></component>
                    {{ item.label }}
                </router-link>
            </a-menu-item>
    </a-menu>
</template>
<script>
import { defineComponent, reactive} from 'vue';
import { storeToRefs } from 'pinia'
import { useMenu } from '../stores/use-menu';
import { UserOutlined,TagOutlined,SettingOutlined} from '@ant-design/icons-vue';
export default defineComponent({
    components:{
        UserOutlined,
        TagOutlined,
        SettingOutlined
    },
    setup(){
        const store = useMenu();
        // const {selectedKeys,openKeys} = store;
        const items = reactive([
        {
            key: '1',
            label: 'Tai Khoan',
            title: 'Tai Khoan',
            name: 'admin-users',
            icon: UserOutlined
        },
        {
            key: '2',
             label: 'Vai Tro',
             title: 'Vai Tro',
            name: 'admin-roles',
            icon: TagOutlined
        },
        {
            key: '3',
            label: 'Cai Dat',
            title: 'Cai Dat',
            name: 'admin-setting',
            icon: SettingOutlined
        },
    ]);
    return{
        // co the return theo cach nay nma hay sd pinia
        // selectedKeys,
        // openKeys,
        items,
        ...storeToRefs(store)
    }
    }
    

})

</script>