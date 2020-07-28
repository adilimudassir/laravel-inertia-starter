const state = () => ({
    type: '',
    text: '',
    show: false,
});

const mutations = {
    FLASH_MESSAGE(state, payload) {
        Object.assign(state, { ...payload, show: true });
    },
    CLEAR_MESSAGE(state) {
        Object.assign(state, { type: '', text: '', show: false });
    }
}

const actions = {
    flashMessage(context, payload) {
        if (context.state.show) context.commit('CLEAR_MESSAGE');

        setTimeout(() => {
            context.commit('FLASH_MESSAGE', payload);
        }, 1000);
    },
    clearMessage(context) {
        context.commit('CLEAR_MESSAGE')
    }
}

const getters = {
    flashMessage: state => {
        return { ...state }
    }
}

export default {
    state,
    mutations,
    actions,
    getters
}