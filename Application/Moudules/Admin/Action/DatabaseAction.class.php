<?php
//产品
class DatabaseAction extends Action {

	public function index()
	{

		if( $this->_post('ok') )
		{
			print_r( $this->_post('sql') );
			
//			$sql = 'select p.id,p.title,p.intro,c.name,p.status from '.getTableName('product').' as p left join '.getTableName('category').' as c on p.category=c.id
//				where 1
//				limit 100';

			//取的结果
			$fields = '';
			$result = '';
			$M = M();
			$res = $M->query( $this->_post('sql') );

			foreach($res as $row)
			{
				$result .= '<tr>';
				foreach($row as $v)
				{
					$result .= '<td height="10px">'.$v.'</td>';
				}
				$result .= '</tr>';
			}
/*
			//取title,表头
			$fields = '';
			$i = 0;
			$num = mysql_num_fields($res);
			while ($i < $num)
			{
				$fields .= '<th>'.mysql_field_name($res,$i).'</th>';
				$i++;
			}
			*/
		}

		echo '<html>
				<style>
				body{ font-size:10px; }
				table{ border:1px solid; padding:0px; margin:0px; }
				table th { border:1px solid; }
				table td { border: 1px solid; height:10px;};
				</style>
				<body>
					<form action="" method="post" style=" position: fix;">
						<textarea name="sql" style="width: 800; height: 100;" >'.$this->_post['sql'].'</textarea>
						<input type="submit" name="ok" value="ok">
					</form>
					<div>
						<table>
							<thead>
								'.$fields.'
							</thead>
							<tbody>
							'.$result.'
							</tbody>
						</table>
					</div>
				</body>
			</html>';

	}
}