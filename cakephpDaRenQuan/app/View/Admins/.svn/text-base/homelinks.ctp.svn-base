<div class="container">
	<div class="span9">
		<div class="page-header">
			<h3>常用链接管理</h3>
			<h4><small>常用链接管理</small></h4>
		</div>
		
		<table id="table" class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 40%;">标题</th>
                <th style="width: 40%;">链接</th>
                <th style="width: 20%;">操作</th>
              </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($homeLinksArray as $homelink)
                    {
	                    echo '<tr><form action="/admins/homelinksmanager" method="post">';
	                    echo '<td>'.$homelink['name'].'</td>';
	                    echo '<td>'.$homelink['link'].'</td>';
	                    echo '<td>';
	                    echo '<input style="display: none;" name="data[op]" value="del" />';
	                    echo '<input style="display: none;" name="data[name]" value="'.$homelink['name'].'" />';
	                    echo '<input style="display: none;" name="data[link]" value="'.$homelink['link'].'" />';
	                    echo '<input type="submit" class="btn btn-danger" value="删除" />';
		                echo "</td>";
		                echo '</form></tr>';
                    }
                ?>	                  
            </tbody>
          </table>
		
		<form action="/admins/homelinksmanager" method="post">
		<div>
			<input type="text" id="title" style="display: none;" name="data[op]" value="add"><br/>
			<input type="text" id="title" style="width: 500px;" name="data[name]" placeholder="请输入标题"><br/>
			<input type="text" id="title" style="width: 500px;" name="data[link]" placeholder="请输入链接地址"><br/>
		</div>
		
		<br />
		<input type="submit" value="添加" class="btn btn-primary">
		</form>
	</div>
</div>