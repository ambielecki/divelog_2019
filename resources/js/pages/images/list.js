let app = new Vue({
    el: '#image_list_app',
    data: {
        images: {},
        selected_image: {},
        page: 1,
        limit: 25,
        count: null,
    },
    mounted: function () {
        Axios.get('/api/admin/images', {
            params: {
                page: this.page,
                limit: this.limit,
            }
        }).then(function (response) {
            console.log(response);
        }).catch(function (error) {
            console.log(error);
        });
    },
});
