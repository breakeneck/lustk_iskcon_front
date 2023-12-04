export const useApi = async(url: string, payload = null) => {
    const options = !payload ? {} : {
        method: 'POST',
        body: payload
    }
    const API_URL = useRuntimeConfig().public.apiUrl;
    const {data} = await useFetch(API_URL + url, addDefaultOpts(options));
    return data.value;
}

function addDefaultOpts(options: Object) {
    const user = useUserStore();
    if (user.isLogged) {
        options.headers = {
            Authorization: 'Bearer ' + user.model.access_token
        };
    }
    options.lazy = true;

    return options;
}