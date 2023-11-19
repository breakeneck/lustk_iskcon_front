function getApiUrl() {
    // console.log('apiurl', process.server ? useRuntimeConfig().apiUrl : useRuntimeConfig().public.apiUrl);
    // return process.server ? useRuntimeConfig().apiUrl : useRuntimeConfig().public.apiUrl;
    // return 'http://127.0.0.1:5500/api'
    return 'http://localhost:5500/api'
    // return useRuntimeConfig().public.apiUrl
}

export const useGet = async (path) => {
    const options = {};
    return await useFetch(getApiUrl() + path, addDefaultOpts(options));
}

export const usePost = async (path, payload) => {
    const options = {
        method: 'POST',
        body: payload
    }
    return await useFetch(getApiUrl() + path, addDefaultOpts(options));
}

export const useApi = async(url, payload = null) => {
    const options = !payload ? {} : {
        method: 'POST',
        body: payload
    }

    // console.log('SEPARATOR');
    // console.log('server', process.env);
    // console.log('client', process.env.NUXT_API_URL);
    // console.log('public', process.env.NUXT_PUBLIC_API_URL);

    const API_URL = useRuntimeConfig().nitro ? useRuntimeConfig().apiUrl : useRuntimeConfig().public.apiUrl;
    console.log('config', API_URL);
    // console.log('config', process.server ? useRuntimeConfig().apiUrl : useRuntimeConfig().public.apiUrl);

// console.log('SEPARATOR');
    const {data} = await useFetch(API_URL + url, addDefaultOpts(options));
    console.log(API_URL + url, data);
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