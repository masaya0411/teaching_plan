<template>
    <div>
        <div class="row">
            <div v-for="status in statuses" :key="status.slug" class="col-sm-4 mb-4">
                <div class="card bg-light text-dark">
                    <div class="card-header d-flex justify-content-around">
                        <h3 class="card-title mb-0" style="font-size: 28px;">
                            {{ status.sutatuse_name }}
                        </h3>
                        <h3 class="card-title mb-0 h3">
                            {{ addStatusTime(status.slug) }} 分
                        </h3>
                    </div>
                    <div class="card-body text-dark">

                        <ul v-bind:id="status.slug">
                            <draggable
                                class="overflow-hidden"
                                v-model="status.tasks"
                                v-bind="taskDragOptions"
                                @end="handleTaskMoved"
                            >
                                <transition-group tag="div">
                                    <div 
                                        v-for="task in status.tasks" 
                                        :key="task.id" 
                                        class="p-task mb-2"
                                    >
                                        <li class="p-task__list overflow-hidden bg-white border rounded">
                                            <i class="far fa-circle my-2"></i>
                                            <span class="p-task__editText ml-2">{{ task.task_name }}</span>
                                            <button aria-label="Delete task"
                                                    class="float-right mx-2 my-2 text-danger u-delete-btn"
                                                    @click="onDelete(task.id, status.id)"
                                            >
                                            <Trash2Icon/>
                                            </button>
                                            <a 
                                            class="overflow-hidden" 
                                            data-toggle="collapse" 
                                            v-bind:href="'#menu' + task.id" 
                                            v-bind:aria-controls="'#menu' + task.id" 
                                            aria-expanded="false">
                                                <i class="fas fa-chevron-up mx-2 my-2 float-right"></i>
                                            </a>
                                        </li>
                                        <ul 
                                        v-bind:id="'menu' + task.id" 
                                        class="collapse p-task__item" 
                                        v-bind:data-parent="'#' + status.slug">
                                            <li class="d-flex align-items-center">
                                                時間：<span class="d-block text-center">
                                                    {{ task.time }}
                                                    </span>分
                                            </li>
                                            <li>
                                                留意点：<p class="h5 p-2 mt-2" v-show="task.description.length" style="height: 100%;">
                                                    {{ task.description }}
                                                    </p>
                                            </li>
                                        </ul>
                                    </div>
                                </transition-group>
                            </draggable>
                        </ul>

                        <!-- AddTaskForm -->
                        <AddTaskForm 
                            v-if="newTaskForStatus === status.id" 
                            :status-id="status.id"
                            :lesson-id="status.lesson_id"
                            v-on:task-added="handleTaskAdded" 
                            v-on:task-canceled="closeAddTaskForm"
                        />
                        <!-- /AddTaskForm -->

                        <button v-show="status.tasks.length" 
                                @click="openAddTaskForm(status.id)"
                                class="u-task-btn">追加　+</button>


                        <div v-show="!status.tasks.length && newTaskForStatus !== status.id">
                            <span class="text-gray h4 d-block text-center">No Task</span>
                            <button class="u-task-btn"
                                    @click="openAddTaskForm(status.id)"
                            >
                            追加　+
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <chart-pie :chart-data="datacollection"></chart-pie>
    </div>
</template>

<script>
import AddTaskForm from "./AddTaskForm";
import draggable from "vuedraggable";
import {Trash2Icon} from "vue-feather-icons";
import ChartPie from "./ChartPie";

export default {
    components: { 
        AddTaskForm,
        draggable,
        Trash2Icon,
        ChartPie,
    },
    props: {
        initialData: Array,
    },
    data() {
        return {
            statuses: [],

            newTaskForStatus: 0,

            datacollection: null

        };
    },
    computed: {
        taskDragOptions () {
            return {
                animation: 200,
                group: "task-list",
                dragClass: "status-drag"
            }
        }
    },
    created() {
    },
    mounted() {
        this.statuses = JSON.parse(JSON.stringify(this.initialData));
        this.fillData();
    },
    methods: {
        openAddTaskForm(statusId) {
            this.newTaskForStatus = statusId;
        },
        closeAddTaskForm() {
            this.newTaskForStatus = 0;
        },
        handleTaskAdded(newTask) {
            const statusIndex = this.statuses.findIndex(
                status => status.id === newTask.status_id
            );

            // 新しく作成しタスクを追加
            this.statuses[statusIndex].tasks.push(newTask);

            this.fillData();
            this.closeAddTaskForm();
        },
        handleTaskMoved() {
            axios.put("/tasks/sync", {columns: this.statuses})
                .then(res => {
                    console.log(res.data);
                })
                .catch(err => {
                    console.log(err.response);
                });
        },
        onDelete(taskId, statusId) {
            const statusIndex = this.statuses.findIndex(
                status => status.id === statusId
            );
            const taskIndex = this.statuses[statusIndex].tasks.findIndex(
                id => taskId
            );
            if(confirm('タスクを削除しますか？')) {
                axios
                    .delete("/tasks/" + taskId, taskId)
                    .then(res => {
                        this.statuses[statusIndex].tasks.splice(taskIndex, 1);
                        this.fillData();
                    })
                    .catch(err => {
                        console.log(err);
                    });
            }
        },
        addStatusTime(statusSlug) {
            var sum = 0;
            if(statusSlug === 'introduction') {
                for (var i = 0; i < this.statuses[0].tasks.length; i++) {
                    sum += this.statuses[0].tasks[i].time;
                }
            }else if(statusSlug === 'development') {
                for (var i = 0; i < this.statuses[1].tasks.length; i++) {
                    sum += this.statuses[1].tasks[i].time;
                }
            }else if(statusSlug === 'summary') {
                for (var i = 0; i < this.statuses[2].tasks.length; i++) {
                    sum += this.statuses[2].tasks[i].time;
                }
            }
            return sum;
        },
        fillData() {
            this.datacollection = {
                labels: ['導入', '展開', 'まとめ'],
                datasets: [
                    {
                        backgroundColor: ["#ffd3d3", "#fff9b4", "#6090EF"],
                        borderColor: 'transparent',
                        label: '授業',
                        data: [this.addStatusTime('introduction'), this.addStatusTime('development'), this.addStatusTime('summary')]
                    }
                ]
            }
        },
    }
};
</script>

<style scoped>
.status-drag {
    transition: transform 0.5s;
    transition-property: all;
}
</style>