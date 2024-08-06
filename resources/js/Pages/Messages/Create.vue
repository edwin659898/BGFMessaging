
<template>
    <Head title="Create message" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Generate message</h2>
        </template>

        <div class="py-12">
            <div class="max-w-full sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        <form @submit.prevent="submit">
                            <div class="mt-4">
                                <InputLabel class="mb-2 text-green-600" for="type" value="Type" />

                                <Multiselect v-model="form.type" placeholder="Message type" :options="{
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
                                <InputLabel class="mb-2 text-green-600" for="delivery_mode" value="Mode of sending the message" />

                                <Multiselect v-model="form.delivery_mode" placeholder="Select mode" :options="{
                                    email:'Email',
                                    sms:'SMS',
                                    letter:'Letter',
                                }" />

                                <InputError class="mt-2" :message="errors.delivery_mode" />
                            </div>

                            <div class="mt-4">
                                <InputLabel class="mb-2 text-green-600" for="employee" value="Employee" />

                                <Multiselect  v-model="form.employee" placeholder="Select Employee" :options="users" track-by="id" label="name"/>

                                <InputError class="mt-2" :message="errors.employee" />
                            </div>

                            <div class="mt-4">
                                <InputLabel class="mb-2 text-green-600" for="prompt" value="Message" />

                                <QuillEditor theme="snow" v-model:content="form.prompt" contentType="html" />

                                <InputError class="mt-2" :message="errors.prompt" />
                            </div>

                            <div class="flex items-center justify-between mt-4">
                                <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                    class="w-full h-12 px-6 text-green-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800">Submit</button>
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
import { Head } from '@inertiajs/vue3';
import Multiselect from '@vueform/multiselect';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';

const props = defineProps({
    errors: Object,
    users: Object,
})

const form = useForm({
    type: '',
    employee:'',
    prompt: '',
    delivery_mode:'',
});

const submit = () => {
    form.post(route('message.store'), {
        onFinish: () => form.reset('type', 'prompt','mode','employee'),
    });
};

</script>
<style src="@vueform/multiselect/themes/default.css"></style>