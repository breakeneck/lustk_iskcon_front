// interface User {
//     id: number,
//     name: string,
//     email: string,
//     password: string,
//     access_token: string,
//     create_time: number,
//     update_time: number,
// }
//
// interface State {
//     model: User
// }

export const useBookStore = defineStore('book', {
    state: () => {
        return {
            tabs: []
        }
    },
    getters: {
    },
    actions: {
    },
    persist: true,
});
