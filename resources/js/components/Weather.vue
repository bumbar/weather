<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Weather Component</div>
                    <div class="card-body">
                            <ul class="list-group list-group-horizontal">
                                <li class="list-group-item" v-for="item in items">
                                    {{ item.day }}
                                    <img :src="'http://openweathermap.org/img/w/' + item.icon + '.png'" :title="item.description">
                                    {{ item.temperature.toFixed(0) }} &#8451;
                                </li>
                            </ul>
                        <select @click="onChange()" v-model="selected">
                            <option value="Sofia">Sofia</option>
                            <option value="Plovdiv">Plovdiv</option>
                            <option value="Varna">Varna</option>
                        </select>
                        <input type="checkbox" id="checkbox" name="favorite" v-model="checked" @change="onChangeCheckbox"> Set as favorite<br>
                        <h1 v-show="ok">{{ selected }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                items: [],
                selected: 'Sofia',
                checked: false,
                ok: true
            }
        },
        created() {
            let favorite = this.$cookie.get('favorite') ? this.$cookie.get('favorite') : 'Sofia';

            this.selected = favorite;

            axios.get('/getweather/' + favorite)
                .then(res => {
                    this.items = JSON.parse(res.data);
                }).catch(err => {
                console.log(err)
            });
        },
        methods: {
            onChange() {
                let id = event.target.value;
                axios.get('/getweather/' + id)
                    .then(res => {
                        this.items = JSON.parse(res.data);
                    }).catch(err => {
                    console.log(err)
                });
            },
            onChangeCheckbox(){
                //cookie expires in one day
                this.$cookie.set('favorite', this.selected, 1);
            }
        }
    }
</script>
