<template>
    <div>
        <draggable v-model="inputs" handle=".handler">
            <div id="items" v-for="(item, key) in inputs" :key="key">
                <div class="input-group input-group-sm">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger" @click="removeInput(key)">
                            <i class="fa fa-minus-circle"></i>
                        </button>
                    </div>
                    <input class="form-control" type="text" :name="`${name}[${key}][link]`" v-model="inputs[key].link" placeholder="Ссылка" v-focus/>
                    <div class="input-group-btn handler">
                        <button type="button" class="btn btn-warning">
                            <i class="fa fa-arrows-v"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group form-group-sm">
                    <input class="form-control" type="text" :name="`${name}[${key}][title]`" v-model="inputs[key].title" placeholder="Текст"/>
                </div>
            </div>
        </draggable>
        <button type="button" class="btn btn-sm btn-success" @click="addInput">
            <i class="fa fa-plus-circle"></i>
        </button>
    </div>
</template>

<script>
    import Draggable from 'vuedraggable';

    export default {
        components: {
            Draggable,
        },
        props: {
            items: {
                type: String,
            },
            name: {
                type: String,
            },
        },
        data() {
            return {
                inputs: JSON.parse(this.items),
            }
        },
        methods: {
            addInput() {
                this.inputs.push({link: '', title: ''});
            },
            removeInput(index) {
                this.inputs.splice(index, 1);
            },
        },
        watch: {
            inputs: {
                handler(val) {
                    this.$emit('input', val);
                },
                deep: true,
            }
        }
    }
</script>
