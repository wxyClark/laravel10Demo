
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('SQL 查询工具') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- SQL 查询表单 -->
                    <form method="POST" action="{{ route('dev.list') }}">
                        @csrf

                        <!-- SQL 语句输入框 -->
                        <div class="mb-6">
                            <x-input-label for="sql" :value="__('SQL 语句')" />
                            <textarea
                                id="sql"
                                name="sql"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm"
                                rows="6"
                                placeholder="请输入 SELECT 查询语句，例如：SELECT * FROM users"
                                required
                                autofocus
                            >{{ old('sql', $sql ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('sql')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">仅支持 SELECT 查询语句</p>
                        </div>

                        <!-- 分页数量选择 -->
                        <div class="mb-6">
                            <x-input-label for="page_size" :value="__('分页数量')" />
                            <select
                                id="page_size"
                                name="page_size"
                                class="block mt-1 w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 shadow-sm"
                            >
                                <option value="10" {{ (old('page_size', $pageSize ?? 10) == 10) ? 'selected' : '' }}>10</option>
                                <option value="20" {{ (old('page_size', $pageSize ?? 10) == 20) ? 'selected' : '' }}>20</option>
                                <option value="50" {{ (old('page_size', $pageSize ?? 10) == 50) ? 'selected' : '' }}>50</option>
                            </select>
                            <x-input-error :messages="$errors->get('page_size')" class="mt-2" />
                        </div>

                        <!-- 执行按钮 -->
                        <div class="flex items-center justify-end">
                            <x-primary-button>
                                {{ __('Execute') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- 查询结果展示区域 -->
                    @if(isset($data) && isset($data['list']) && count($data['list']) > 0)
                    <div class="mt-8">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">查询结果</h3>

                            <!-- 导出按钮 -->
                            <div class="flex space-x-2">
                                <form method="POST" action="{{ route('dev.export') }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="sql" value="{{ $sql }}">
                                    <input type="hidden" name="type" value="excel">
                                    <x-secondary-button type="submit">
                                        {{ __('Export Excel') }}
                                    </x-secondary-button>
                                </form>

                                <form method="POST" action="{{ route('dev.export') }}" class="inline">
                                    @csrf
                                    <input type="hidden" name="sql" value="{{ $sql }}">
                                    <input type="hidden" name="type" value="json">
                                    <x-secondary-button type="submit">
                                        {{ __('Export JSON') }}
                                    </x-secondary-button>
                                </form>
                            </div>
                        </div>

                        <!-- 分页信息 -->
                        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                            共 {{ $data['total'] }} 条记录，当前显示第 {{ $data['page'] }} 页，每页 {{ $data['page_size'] }} 条
                        </div>

                        <!-- 数据表格 -->
                        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    @foreach(array_keys($data['list'][0]) as $column)
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">{{ $column }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($data['list'] as $row)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    @foreach($row as $value)
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $value }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- 分页导航 -->
                        @if($data['total'] > $data['page_size'])
                        <div class="mt-6">
                            {{ $data['list']->links() }}
                        </div>
                        @endif
                    </div>
                    @elseif(isset($data) && isset($data['list']) && count($data['list']) === 0)
                    <div class="mt-8 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-md">
                        <p class="text-yellow-800 dark:text-yellow-200">查询成功，但没有找到匹配的记录。</p>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
