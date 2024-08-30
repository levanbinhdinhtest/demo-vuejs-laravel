import { defineStore } from 'pinia'

export const useMenu = defineStore('menuId', {
  // arrow function recommended for full type inference
  state: () => {
    return {
      // all these properties will have their type inferred automatically
      selectedKeys: [],
      openKeys: [],
    }
  },
  actions:{
    onSelectedKeys(data){
        this.selectedKeys = data;
    },
    onOpenKeys(data){
        this.openKeys = data;
    }
  }
})