let app = new Vue({
    el: '#blog_app',
    data: {
        count: null,
        errors: {},
        images: [],
        images_loading: false,
        limit: 20,
        page: 1,
        pages: null,
        search: null,
        selected_image: {},
    },
    mounted: function () {
        this.getImageList();
    },
    methods: {
        imageThumbClick(clicked_image) {

        },

        paginationClick(page) {
            this.page = page;
            this.getImageList();
        },

        getImageList() {
            this.images_loading = true;
            Axios.get('/api/admin/images', {
                params: {
                    page: this.page,
                    limit: this.limit,
                    search: this.search,
                    is_hero: this.image_destination === 'for_hero',
                }
            }).then(function (response) {
                app.images_loading = false;
                app.images = response.data.images;
                app.count = response.data.count;
                app.limit = response.data.limit;
                app.page = response.data.page;
                app.pages = response.data.pages;
                app.selected_image = {};

                app.images.forEach(function (image, index) {
                    Vue.set(app.images[index], 'is_active', false);
                });
            }).catch(function (error) {
                this.images_loading = false;
                console.log(error);
            });
        },

        searchImages: DiveLogRepeat.debounce(function () {
            this.getImageList();
        }, 500),

        checkSlug: DiveLogRepeat.debounce(function () {

        }, 500),
    },
});
