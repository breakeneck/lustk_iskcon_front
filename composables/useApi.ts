const API_URL = 'http://localhost:5500';

export const useGet = async (path) => {
    const options ={};
    return await useFetch(API_URL + path, addAuth(options));
}

export const usePost = async (path, payload) => {
    const options = {
        method: 'POST',
        body: payload
    }
    return await useFetch(API_URL + path, addAuth(options));
}

function addAuth(options) {
    const user = useUserStore();

    if (user.isLogged) {
        options['headers'] = {
            Authorization: 'Bearer ' + user.model.access_token
        };
    }
    return options;
}