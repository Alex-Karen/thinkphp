<?php

namespace app\admin\controller;

use app\admin\validate\ArticleValidate;
use app\common\model\Articles;
use think\Controller;
use think\Request;

class Article extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = model('articles')->paginate(3);

        return view('admin@article/index', compact('data'));
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        // 读取栏目
        $data = db('cates')->select();

        return view('admin@article/create', compact('data'));
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $input = $request->post();
        $ret = $this->validate($input, ArticleValidate::class);

        if (true !== $ret) {
            $this->error($ret);
        }
        // 入库
        $userinfo = session('admin.user');
//        dump($userinfo);die;
        $input['users_id'] = $userinfo['id'];
        $ret = Articles::create($input);
        return redirect(url('article/index'));
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     * @return \think\Response
     */
    public function edit(int $id)
    {
        // 根据ID查询
        $data = Articles::find($id);
        // 读取栏目
        $cdata = db('cates')->select();

        return view('admin@article/edit', compact('data', 'cdata'));
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->put();
        // 验证
        $ret = $this->validate($input, ArticleValidate::class);
        if (true !== $ret) {
            $this->error($ret);
        }
        // 修改数据
        unset($input['__token__']);
        unset($input['_method']);
        Articles::where('id', $id)->update($input);
        // 跳转
        return redirect(url('article/index'));
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete(int $id)
    {
        Articles::destroy($id);

        $data = Articles::paginate(3)->toArray();
        #return json(['status' => 0, 'msg' => '删除成功']);
        return json($data);
    }
}
