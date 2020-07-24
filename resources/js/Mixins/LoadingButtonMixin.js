export const LoadingButtonMixin = {
    watch: {
        loader() {
            const l = this.loader
            this[l] = !this[l]

            setTimeout(() => (this[l] = false), 2000)

            this.loader = null
        },
    },
    data(){
        return {
            loader: null,
            loading: false

        }
    }
}