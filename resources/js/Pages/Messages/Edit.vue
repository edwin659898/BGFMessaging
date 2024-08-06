
<template>
    <Head title="Edit message" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit message</h2>
        </template>

        <div class="py-12">
            <div class="max-w-full sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <form>
                            <div class="mt-4">
                                <InputLabel class="mb-2 text-green-600" for="type" value="Type" />

                                <Multiselect v-model="form.type" :options="{
                                    Anniversary: 'Anniversary',
                                    Birthday: 'Birthday',
                                    Congratulatory_message:'Congratulatory message',
                                    Fathers_day: 'Fathers day',
                                    Mothers_day: 'Mothers day',
                                    Warning_letter:'Warning letter',
                                }" />

                                <InputError class="mt-2" :message="errors.type" />
                            </div>

                            <div class="mt-4">
                                <InputLabel class="mb-2 text-green-600" for="message" value="Message" />

                                <QuillEditor theme="snow" v-model:content="form.message" contentType="html" />

                                <InputError class="mt-2" :message="errors.message" />
                            </div>

                            <div class="flex items-center justify-between mt-4 space-x-3">
                                <button @click.prevent="send()" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                    class="w-full h-12 px-6 text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800">Approve and send</button>
                                <button @click.prevent="sendForReview()" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                    class="w-full h-12 px-6 text-orange-100 transition-colors duration-150 bg-purple-700 rounded-lg focus:shadow-outline hover:bg-purple-800">Send for review</button>
                                    <button @click.prevent="submit()" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                    class="w-full h-12 px-6 text-green-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">Save as Draft</button>
                                    <button @click.prevent="regenerate()" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                    class="w-full h-12 px-6 text-green-100 transition-colors duration-150 bg-blue-700 rounded-lg focus:shadow-outline hover:bg-blue-800">Regenerate with Comments</button>
                                    <button @click.prevent="destroy()" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                    class="w-full h-12 px-6 text-green-100 transition-colors duration-150 bg-red-700 rounded-lg focus:shadow-outline hover:bg-red-800">Discard</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Multiselect from '@vueform/multiselect';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({errors: Object, message: Object})

const form = useForm({
    type: props.message.type,
    message: props.message.message,
})

const submit = () => {
    if((form.message).replace(/<\/?[^>]+(>|$)/g, "") == ''){
        alert('message is required');
    }else{
        form.patch(route('message.update', { id: props.message.id }), {
            onFinish: () => form.reset('type', 'message'),
        });
    }
};

const send = () => {
    if((form.message).replace(/<\/?[^>]+(>|$)/g, "") == ''){
        alert('message is required');
    }else{
        form.patch(route('message.send', { id: props.message.id }), {
            onFinish: () => form.reset('type', 'message'),
        });
    }
};

const sendForReview = () => {
    if((form.message).replace(/<\/?[^>]+(>|$)/g, "") == ''){
        alert('message is required');
    }else{
        form.patch(route('message.sendforreview', { id: props.message.id }), {
            onFinish: () => form.reset('type', 'message'),
        });
    }
};

const regenerate = () => {
    if((form.message).replace(/<\/?[^>]+(>|$)/g, "") == ''){
        alert('message is required');
    }else{
        form.patch(route('message.regenerate', { id: props.message.id }), {
            onFinish: () => form.reset('type', 'message'),
        });
    }
};

const destroy = () => {
    form.delete(route('message.delete', { id: props.message.id }), {
            onFinish: () => form.reset('type', 'message'),
        });
};


</script>
<style src="@vueform/multiselect/themes/default.css"></style>