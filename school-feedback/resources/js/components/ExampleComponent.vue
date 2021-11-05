<template>
    <div class="container relative flex items-top justify-center  min-h-screen bg-gray-100  sm:items-center py-4 sm:pt-0">
        <div class="row justify-content-center text-white">
                <button @click="(source == 'DB') ? source = 'File' : source = 'DB'; getList()" class="btn btn-success" type="button" id="dropdownMenuButton1">
                    Сохранять в {{ (source == 'DB') ? 'БД' : 'файл' }}
                </button>
        </div>
        <div class="row justify-content-center text-center p-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h1 class="form-label">Оставить заявку</h1>
                    </div>
                    <div class="card-body">
                        <div class="input-group flex-nowrap p-2">
                            <span class="input-group-text">@</span>
                            <input v-model="newEntry.name" type="text" class="form-control" placeholder="Ваше имя"
                                   aria-label="Username" aria-describedby="addon-wrapping">
                        </div>
                        <div class="input-group flex-nowrap p-2">
                            <span class="input-group-text">+7</span>
                            <input v-model="newEntry.phone" maxlength="10" type="number" class="form-control" placeholder="Номер телефона"
                                   aria-label="Username" aria-describedby="addon-wrapping">
                        </div>
                        <div class="input-group flex-nowrap p-2">
                        <textarea v-model="newEntry.content" class="form-control"
                                  placeholder="Ваше сообщение..."></textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" @click.prevent="addEntry()" class="btn btn-primary">Добавить отзыв</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center text-white">
            <div class="col-md-8">
                <div v-for="item in list" :key="item.id" class="card font-weight-bolder text-white">
                    <div class="card-header bg-info d-flex justify-content-around p-2.5">
                        <div>
                            <h4>
                                {{ item.name }}
                            </h4>
                        </div>
                        <div>
                            <h4>{{ item.phone }}</h4>
                        </div>
                    </div>
                    <div class="card-body border border-info text-dark">
                        <div>
                            <h4>{{ item.content }}</h4>
                        </div>
                        <div>
                            {{ formatDate(item.created_at) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>
.card {
    width: 600px;
}

.card-header {
    color: white;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.card-body {
    padding: 10px 20px;
}
</style>

<script>

import axios from 'axios'

export default {

    data: () => {
        return {
            source: 'DB',
            list: [],
            page: 1,
            count: 20,
            newEntry: {
                name: '',
                phone: '',
                content: '',
            }
        }
    },
    mounted() {
        this.getList();
    },
    methods: {
        addEntry() {
            this.newEntry.source = this.source;

            axios.post(`/api/feedback/`, this.newEntry)
            .then((response) => {
                this.getList();
            })
            .catch((error) => {
                alert(Object.values(error.response.data.errors).join(','));
            })
        },
        formatDate(date) {
            return new Date(date).toLocaleDateString("ru-RU");
        },
        getList() {
            axios.get(`/api/feedback/${this.source}/${this.page}/${this.count}`).then((data) => {
                this.list = data.data
            })
        }
    }
}
</script>
