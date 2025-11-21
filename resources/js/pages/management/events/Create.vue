<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { Button } from '@/components/ui/button';
import { Calendar } from '@/components/ui/calendar';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from '@/components/ui/popover';
import AppLayout from '@/layouts/AppLayout.vue';
import management from '@/routes/management';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {
    type DateValue,
    DateFormatter,
    getLocalTimeZone,
    today,
} from '@internationalized/date';
import { CalendarIcon } from 'lucide-vue-next';
import { ref } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Thêm sự sự kiện',
        href: management.events.create().url,
    },
];

const df = new DateFormatter('vi-VN', { dateStyle: 'long' });
const defaultPlaceholder = today(getLocalTimeZone());

const startEvent = ref<DateValue>();
const endEvent = ref<DateValue>();
const startApplication = ref<DateValue>();
const endApplication = ref<DateValue>();

const startEventPopoverOpen = ref(false);
const endEventPopoverOpen = ref(false);
const startApplicationPopoverOpen = ref(false);
const endApplicationPopoverOpen = ref(false);

const form = useForm({
    name: '',
    title: '',
    sub_title: '',
    start_date_event: '',
    expired_date_event: '',
    start_date_application: '',
    end_date_application: '',
    first_contact: '',
    first_phone: '',
    second_contact: '',
    second_phone: '',
});

function formatForInput(date?: DateValue) {
    return date
        ? date.toDate(getLocalTimeZone()).toISOString().substring(0, 10)
        : '';
}

const handleSubmit = () => {
    form.post(management.events.store().url);
};
</script>

<template>
    <Head title="Thêm sự kiện" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-4">
            <Link :href="management.events.index().url">
                <Button variant="outline">Quay lại</Button>
            </Link>

            <form @submit.prevent="handleSubmit" class="space-y-4">
                <Label>Tên sự kiện</Label>
                <Input v-model="form.name" placeholder="Tên sự kiện" />
                <div class="text-sm text-red-600" v-if="form.errors.name">
                    {{ form.errors.name }}
                </div>

                <Label>Tiêu đề</Label>
                <Input v-model="form.title" placeholder="Tiêu đề" />
                <div class="text-sm text-red-600" v-if="form.errors.title">
                    {{ form.errors.title }}
                </div>

                <Label>Tiêu đề phụ</Label>
                <Input v-model="form.sub_title" placeholder="Tiêu đề phụ" />
                <div class="text-sm text-red-600" v-if="form.errors.sub_title">
                    {{ form.errors.sub_title }}
                </div>

                <!-- ========== NGÀY SỰ KIỆN ========== -->
                <Label>Ngày bắt đầu và kết thúc sự kiện</Label>
                <div class="flex flex-col gap-4 md:flex-row">
                    <Popover v-model:open="startEventPopoverOpen">
                        <PopoverTrigger as-child>
                            <Button
                                variant="outline"
                                class="w-[240px] justify-start text-left font-normal"
                            >
                                <CalendarIcon class="mr-2" />
                                {{
                                    startEvent
                                        ? df.format(
                                              startEvent.toDate(
                                                  getLocalTimeZone(),
                                              ),
                                          )
                                        : 'Chọn ngày bắt đầu'
                                }}
                            </Button>
                        </PopoverTrigger>

                        <PopoverContent class="w-auto p-0" align="start">
                            <Calendar
                                v-model="startEvent"
                                :default-placeholder="defaultPlaceholder"
                                initial-focus
                                @update:model-value="
                                    (val) => {
                                        form.start_date_event =
                                            formatForInput(val);
                                        startEventPopoverOpen = false;
                                    }
                                "
                            />
                        </PopoverContent>
                        <div
                            class="text-sm text-red-600"
                            v-if="form.errors.start_date_event"
                        >
                            {{ form.errors.start_date_event }}
                        </div>
                    </Popover>

                    <!-- End date -->
                    <Popover v-model:open="endEventPopoverOpen">
                        <PopoverTrigger as-child>
                            <Button
                                variant="outline"
                                class="w-[240px] justify-start text-left font-normal"
                            >
                                <CalendarIcon class="mr-2" />
                                {{
                                    endEvent
                                        ? df.format(
                                              endEvent.toDate(
                                                  getLocalTimeZone(),
                                              ),
                                          )
                                        : 'Chọn ngày kết thúc'
                                }}
                            </Button>
                        </PopoverTrigger>

                        <PopoverContent class="w-auto p-0" align="start">
                            <Calendar
                                v-model="endEvent"
                                :default-placeholder="defaultPlaceholder"
                                initial-focus
                                @update:model-value="
                                    (val) => {
                                        form.expired_date_event =
                                            formatForInput(val);
                                        endEventPopoverOpen = false;
                                    }
                                "
                            />
                        </PopoverContent>

                        <div
                            class="text-sm text-red-600"
                            v-if="form.errors.expired_date_event"
                        >
                            {{ form.errors.expired_date_event }}
                        </div>
                    </Popover>
                </div>

                <!-- ========== NGÀY NHẬN GIẢI ========== -->
                <Label>Ngày bắt đầu và kết thúc nhận giải</Label>
                <div class="flex flex-col gap-4 md:flex-row">
                    <!-- Start application -->
                    <Popover v-model:open="startApplicationPopoverOpen">
                        <PopoverTrigger as-child>
                            <Button
                                variant="outline"
                                class="w-[240px] justify-start text-left font-normal"
                            >
                                <CalendarIcon class="mr-2" />
                                {{
                                    startApplication
                                        ? df.format(
                                              startApplication.toDate(
                                                  getLocalTimeZone(),
                                              ),
                                          )
                                        : 'Chọn ngày bắt đầu'
                                }}
                            </Button>
                        </PopoverTrigger>

                        <PopoverContent class="w-auto p-0" align="start">
                            <Calendar
                                v-model="startApplication"
                                :default-placeholder="defaultPlaceholder"
                                @update:model-value="
                                    (val) => {
                                        form.start_date_application =
                                            formatForInput(val);
                                        startApplicationPopoverOpen = false;
                                    }
                                "
                            />
                        </PopoverContent>
                        <div
                            class="text-sm text-red-600"
                            v-if="form.errors.start_date_application"
                        >
                            {{ form.errors.start_date_application }}
                        </div>
                    </Popover>

                    <!-- End application -->
                    <Popover v-model:open="endApplicationPopoverOpen">
                        <PopoverTrigger as-child>
                            <Button
                                variant="outline"
                                class="w-[240px] justify-start text-left font-normal"
                            >
                                <CalendarIcon class="mr-2" />
                                {{
                                    endApplication
                                        ? df.format(
                                              endApplication.toDate(
                                                  getLocalTimeZone(),
                                              ),
                                          )
                                        : 'Chọn ngày kết thúc'
                                }}
                            </Button>
                        </PopoverTrigger>

                        <PopoverContent class="w-auto p-0" align="start">
                            <Calendar
                                v-model="endApplication"
                                :default-placeholder="defaultPlaceholder"
                                @update:model-value="
                                    (val) => {
                                        form.end_date_application =
                                            formatForInput(val);
                                        endApplicationPopoverOpen = false;
                                    }
                                "
                            />
                        </PopoverContent>
                        <div
                            class="text-sm text-red-600"
                            v-if="form.errors.end_date_application"
                        >
                            {{ form.errors.end_date_application }}
                        </div>
                    </Popover>
                </div>

                <!-- Contact -->
                <Label>Người liên hệ thứ nhất</Label>
                <Input
                    v-model="form.first_contact"
                    placeholder="Tên người liên hệ"
                />
                <Label>Số điện thoại</Label>
                <Input v-model="form.first_phone" placeholder="Số điện thoại" />

                <Label>Người liên hệ thứ hai</Label>
                <Input
                    v-model="form.second_contact"
                    placeholder="Tên người liên hệ"
                />
                <Label>Số điện thoại</Label>
                <Input
                    v-model="form.second_phone"
                    placeholder="Số điện thoại"
                />

                <Button type="submit" :disabled="form.processing"> Lưu</Button>
            </form>
        </div>
    </AppLayout>
</template>
