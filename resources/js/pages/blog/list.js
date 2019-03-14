let app = new Vue({
    el: '#blog_list',
    data: {
        count: null,
        errors: {},
        limit: 10,
        page: 1,
        pages: null,
        posts: [],
        posts_loading: false,
        search: null,
    },
    mounted: function () {
        this.getPostList();
    },
    methods: {
        paginationClick(page) {
            this.page = page;
            this.getPostList();
        },

        getPostList() {
            this.posts_loading = true;
            Axios.get('/api/blog/list', {
                params: {
                    page: this.page,
                    limit: this.limit,
                }
            }).then(function (response) {
                app.posts_loading = false;
                app.posts = response.data.posts;
                app.count = response.data.count;
                app.page = response.data.page;
                app.pages = response.data.pages;
            }).catch(function (error) {
                this.posts_loading = false;
                console.log(error);
            });
        },
    },
});
