<template>
    <Head title="Shift" />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex w-[100%] flex-row justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Shift
                </h2>
            </div>
        </template>

        <div class="w-5/6 mx-auto my-16 border border-gray-500 rounded-lg">
            <div
                class="flex flex-row justify-between items-center w-full min-h-min bg-[#21252908] border-b-2"
            >
                <p class="px-4 m-2 text-xl">لیست شیفت ها</p>
                <div>
                    <Link
                        :href="route('shift.create')"
                        as="button"
                        type="button"
                        class="h-8 px-4 m-2 text-sm duration-150 rounded focus:shadow-outline bg-[#FFFF00] hover:bg-[#FFFF00] text-black border border-transparent hover:border-black"
                    >
                        ایجاد شیفت جدید
                    </Link>
                </div>
            </div>
            <ul>
                <li
                    v-for="(shift, index) in shifts"
                    :key="index"
                    class="flex flex-row justify-between w-full min-h-min py-4 px-4 border-b-2 border-neutral-100 items-center hover:bg-[#21252908]"
                >
                    <div class="content flex flex-row w-[20%] justify-between">
                        {{ shift.name }}
                    </div>
                    <div class="content flex flex-row w-[35%] justify-between">
                        <div>
                            شروع :
                            {{ shift.start_time }}
                        </div>
                        <div>
                            پایان :
                            {{ shift.end_time }}
                        </div>
                        <div>
                            حقوق :
                            {{ shift.money }}
                        </div>
                    </div>
                    <div class="min-w-max px-5 flex flex-row justify-between">
                        <Link
                            :href="route('shift.show', shift.id)"
                            as="button"
                            type="button"
                            class="h-8 px-4 flex items-center m-2 text-sm text-indigo-100 transition-colors duration-150 bg-blue-500 hover:bg-blue-800 rounded-lg focus:shadow-outline"
                        >
                            نمایش
                            <EyeIcon class="size-5"></EyeIcon>
                        </Link>

                        <Link
                            :href="route('shift.edit', shift.id)"
                            as="button"
                            type="button"
                            class="h-8 px-4 m-2 flex items-center text-sm transition-colors duration-150 rounded-lg focus:shadow-outline bg-white hover:bg-black text-black hover:text-white border border-black hover:border-transparent"
                        >
                            ویرایش
                            <PencilSquareIcon class="size-5"></PencilSquareIcon>
                        </Link>
                        <button
                            @click="remove(shift.id)"
                            class="h-8 px-4 m-2 flex items-center text-sm text-white duration-150 rounded-lg bg-red-600 border-red-600 border hover:border-black"
                            as="button"
                            type="button"
                        >
                            حذف
                            <TrashIcon class="size-5"></TrashIcon>
                        </button>
                    </div>
                </li>
            </ul>
        </div>
        <p
            class="flex flex-row justify-center text-xl text-center"
            v-if="$page.props.crud.success"
        >
            {{ $page.props.crud.success }}
        </p>
    </AuthenticatedLayout>
</template>

<script>
import { Link, router, usePage, Head, useForm } from "@inertiajs/vue3";
import Dashboard from "@/Pages/Dashboard.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import {
    TrashIcon,
    EyeIcon,
    PencilSquareIcon,
    PlusCircleIcon,
} from "@heroicons/vue/24/solid";

export default {
    components: {
        Link,
        usePage,
        router,
        useForm,
        AuthenticatedLayout,
        Head,
        Dashboard,
        TrashIcon,
        EyeIcon,
        PlusCircleIcon,
        PencilSquareIcon,
    },
    props: {
        shifts: Object,
        errors: Object,
    },
    setup(props) {
        function remove(id) {
            if (confirm("آیا از شیفت اتاق مطمئنید ؟")) {
                router.delete(route("shift.delete", id));
            }
        }

        return { remove };
    },
};
</script>

<style></style>
