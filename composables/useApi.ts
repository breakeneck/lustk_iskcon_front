const API_URL = 'http://localhost:5500';

export const useGet = async (path) => {
    return await useFetch(API_URL + path);
}

export const usePost = async (path, payload) => {
    return await useFetch(API_URL + path, {
        method: 'POST',
        body: payload
    });
}