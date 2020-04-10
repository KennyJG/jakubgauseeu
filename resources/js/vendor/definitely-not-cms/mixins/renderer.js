export default {
    methods: {
        getHtml(id) {
            axios.get('/api/pages/' + id + '/html')
                .then((response) => {
                    this.html = response.data.data;
                }); 
        },
    }
}