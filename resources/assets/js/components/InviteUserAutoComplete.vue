<template>
    <div>
        <!-- Balance type field -->
        <div class="form-group row">
            <label for="name" class="text-md-right col-md-4 col-form-label">
                User name or email
            </label>

            <div class="col-md-8 user-autocomplete-container"
                 :class="{'selected': selected}">
                <input id="name" type="text" class="form-control" name="name" value="" required
                       autocomplete="off"
                       v-model.lazy="name"
                       @keyup="loadList"
                       @focus="onFocus"
                       @blur="onBlur">

                <small class="form-text text-muted">Start write user name or email and select needle member</small>

                <div class="list-group" v-if="selected">
                    <a href="#" class="list-group-item list-group-item-action active">
                        <button type="button" class="close" aria-label="Close" @click="onUnselected">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        {{ user.name }} {{ user.email }}

                        <input type="hidden" name="user_id" :value="user.id">
                    </a>
                </div>

                <div class="list-group user-autocomplete" v-if="users.length && enabled">
                    <a @click.prevent="onSelected($event, user.id)"
                       class="list-group-item list-group-item-action"
                       v-for="user in users">
                        {{ user.name }}
                    </a>
                </div>

            </div>

        </div>
    </div>
</template>
<style>
    .list-group-item.list-group-item-action{
        display: block;
    }
</style>
<script>
    export default{
        data(){
            return{
                enabled: false,
                selected: false,
                users: [],
                user: {},
                name: ''
            }
        },
        methods: {
            loadList: function(event){
                if(this.name == ''){
                    this.enabled = false;
                    this.users = [];
                }else{
                    this.enabled = true;
                    this.$http.post('/balance/invite-user-autocomplete', {
                        name: this.name
                    }).then(this.loaded);
                }
            },
            loaded: function(res){
                this.users = res.json();
            },
            onSelected: function(event, id){
                this.selected = true;
                this.user = _.find(this.users, function(item){
                    return item.id == id;
                });
                this.enabled = false;
            },
            onUnselected: function(){
                this.selected = false;
                this.user = {};
                this.name = '';
            },
            onBlur: function(event){
                var $this = this;
                setTimeout(function(){
                    $this.enabled = false;
                }, 200);
            },
            onFocus: function(event){
                if(this.name != '')
                    this.loadList();
            }
        }
    }
</script>
