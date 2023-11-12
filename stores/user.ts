

interface User {
    id: number,
    name: string,
    email: string,
    password: string,
    access_token: string,
    create_time: number,
    update_time: number,
}

interface State {
    model: User
}

export const useUserStore = defineStore('user', {
    state: (): State => {
        return {
            model: {
                id: 0,
                name: '',
                email: '',
                password: '',
                access_token: '',
                create_time: 0,
                update_time: 0
            }
        }
    },
    getters: {
        isLogged: (state: State) => state.model.id
    },
    actions: {
        saveAuth(model) {
            this.model = model;
        }
    }
});
