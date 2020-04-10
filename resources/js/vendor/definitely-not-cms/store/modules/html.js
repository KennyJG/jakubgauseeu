const state = {
    html: '',
}

const getters = {
    getHtml: (state) => state.html
};

const actions = {
    getRenderedHtml({ commit, dispatch }, id) {
        axios.get('/api/pages/' + id + '/html')
            .then((response) => {
                commit('SET_HTML', response.data.data);
            }).then(() => {
                dispatch('reselect');
            });
    },
};

const mutations = {
    SET_HTML: (state, data) => {
        state.html = data;
    },
};

export default { state, getters, actions, mutations }
