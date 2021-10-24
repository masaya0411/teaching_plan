<template>
    <form 
        class="rounded border border-dark"
        @submit.prevent="handleAddNewTask"
    >
        <div class="p-3">
            <input 
                type="text" 
                class="p-task__list w-100 mt-2 border rounded h4 px-2 py-1" 
                placeholder="学習活動" 
                v-model.trim="newTask.task_name"
            >
            <input 
                type="number" 
                min="0"
                max="99"
                class="p-task__list w-50 mt-2 border rounded h4 px-2 py-1 mr-1" 
                placeholder="時間" 
                v-model.number="newTask.time"
            >分
            <textarea 
                class="p-task__list w-100 mt-2 border rounded h4 p-2" 
                rows="3" 
                placeholder="留意点" 
                v-model.trim="newTask.description"
            ></textarea>
            <div v-show="errorMessage">
                <span class="text-danger">
                    {{ errorMessage }}
                </span>
            </div>
        </div>
        <div class="p-3 d-flex justify-content-end">
            <button 
                @click="$emit('task-canceled')" 
                type="reset" 
                class="h6 px-2 py-w mr-2 bg-secondary text-white border-0 rounded"
            >
                キャンセル
            </button>
            <button 
                type="submit" 
                class="h6 px-3 py-2 bg-primary text-white border-0 rounded"
            >
                登録
            </button>
        </div>
    </form>
</template>

<script>
export default {
    props: {
        statusId: Number,
        lessonId: Number,
    },
    data() {
        return {
            newTask: {
                task_name: "",
                time: null,
                description: "",
                lesson_id: null,
                status_id: null
            },
            errorMessage: ""
        };
    },
    mounted() {
        this.newTask.lesson_id = this.lessonId;
        this.newTask.status_id = this.statusId;
    },
    methods: {
        handleAddNewTask() {
            if(!this.newTask.task_name) {
                this.errorMessage = '学習活動を入力してください';
                return;
            }

            axios
                .post("/tasks", this.newTask)
                .then(res => {
                    this.$emit("task-added", res.data);
                })
                .catch(err => {
                    this.handleErrors(err);
                });
        },
        handleErrors(err) {
            if (err.response && err.response.status === 422) {
                const errorBag = err.response.data.errors;
                if (errorBag.task_name) {
                this.errorMessage = errorBag.task_name[0];
                } else if(errorBag.time) {
                this.errorMessage = errorBag.time[0];
                } else if (errorBag.description) {
                this.errorMessage = errorBag.description[0];
                } else {
                this.errorMessage = err.response.message;
                }
            } else {
                console.log(err.response);
            }
        }
    }
}
</script>