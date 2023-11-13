export default defineNuxtRouteMiddleware((to, from) => {
    if (! useUserStore().isLogged) {
        return navigateTo('/login')
    }
})

