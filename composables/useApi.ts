export const useGet = async (path) => {
    const options = {};
    return await useFetch(useRuntimeConfig().public.apiUrl + path, addDefaultOpts(options));
}

export const usePost = async (path, payload) => {
    const options = {
        method: 'POST',
        body: payload
    }
    return await useFetch(useRuntimeConfig().public.apiUrl + path, addDefaultOpts(options));
}

export const useApi = async(url, payload = null) => {
    const options = !payload ? {} : {
        method: 'POST',
        body: payload
    }
    const {data} = await useFetch(useRuntimeConfig().public.apiUrl + url, addDefaultOpts(options));
    return data.value;
}

function addDefaultOpts(options) {
    const user = useUserStore();

    if (user.isLogged) {
        options['headers'] = {
            Authorization: 'Bearer ' + user.model.access_token
        };
    }
    options.lazy = true;

    return options;
}