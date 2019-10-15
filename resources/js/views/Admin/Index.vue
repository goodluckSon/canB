<template>
    <div class="bg-white text-purple-800 text-center flex flex-wrap content-center h-screen justify-center">
		<div class="info1">
			<dl>
				<dt>受注番号</dt><dd>121256</dd>
			</dl>
			<dl>
				<dt>氏&nbsp;&nbsp;&nbsp;&nbsp;名</dt><dd>丸野丸男</dd>
			</dl>
			<dl>
				<dt>電話番号</dt><dd>012345678</dd>
			</dl>
			<dl>
				<dt>E-Mail</dt><dd>123@21365.com</dd>
			</dl>
		</div>
		<div class="info2">
			<dl>
				<dt>〒</dt><dd>121256</dd>
			</dl>
			<dl>
				<dt>住所1</dt><dd>東京都○○区〇〇3－19－2</dd>
			</dl>
			<dl>
				<dt>住所2</dt><dd>〇〇3－19－2</dd>
			</dl>
			<dl>
				<dt>建物名</dt><dd>オンボロマンション404</dd>
			</dl>
		</div>
		<div class="clear"></div>
		<div class="table_area2">
			<table class="row-head header-check">
  				<thead>
    				<tr>
				      <th width="30"><input type="checkbox"><label></label></th>
				      <th width="30">NO</th>
				      <th width="30">注文日</th>
				      <th width="30">出荷日</th>
				      <th width="400">商品名</th>
				      <th width="30">数量</th>
				      <th width="40">単価</th>
				      <th width="60">金額</th>
				      <th>メモ</th>
				      <th width="50"></th>
    				</tr>
				</thead>
				<tbody>
				    <tr>
				      <td align="center"><input type="checkbox"><label></label></td>
				      <td aria-label="#">0001</td>
				      <td aria-label="注文日">2019/07/07</td>
				      <td aria-label="出荷日">2019/07/07</td>
				      <td aria-label="商品名">iQOS3マルチ aiq0022</td>
				      <td align="right" aria-label="数量">1</td>
				      <td align="right" aria-label="単価">1,780</td>
				      <td align="right" aria-label="金額">1,780</td>
				      <td aria-label="メモ">商品揃ってから出荷</td>
				      <td align="center" class="bt-area">
				        <a href="#" aria-label="編集"><img src="images/edit.png" width="18" height="18"></a>
				        <a href="#" aria-label="削除"><img src="images/delete.png" width="18" height="18"></a>
				      </td>
				    </tr>
				    <tr>
				      <td align="center"><input type="checkbox"><label></label></td>
				      <td aria-label="#">0002</td>
				      <td aria-label="注文日">2019/07/07</td>
				      <td aria-label="出荷日">2019/07/07</td>
				      <td aria-label="商品名">iQOS3マルチ aiq0022</td>
				      <td align="right" aria-label="数量">1</td>
				      <td align="right" aria-label="単価">1,780</td>
				      <td align="right" aria-label="金額">1,780</td>
				      <td aria-label="メモ">商品揃ってから出荷</td>
				      <td align="center" class="bt-area">
				        <a href="#" aria-label="編集"><img src="images/edit.png" width="18" height="18"></a>
				        <a href="#" aria-label="削除"><img src="images/delete.png" width="18" height="18"></a>
				      </td>
				    </tr>
				    <tr>
				      <td align="center"><input type="checkbox"><label></label></td>
				      <td aria-label="#">0003</td>
				      <td aria-label="注文日">2019/07/07</td>
				      <td aria-label="出荷日">2019/07/07</td>
				      <td aria-label="商品名">iQOS3マルチ aiq0022</td>
				      <td align="right" aria-label="数量">1</td>
				      <td align="right" aria-label="単価">1,780</td>
				      <td align="right" aria-label="金額">1,780</td>
				      <td aria-label="メモ">商品揃ってから出荷</td>
				      <td align="center" class="bt-area">
				        <a href="#" aria-label="編集"><img src="images/edit.png" width="18" height="18"></a>
				        <a href="#" aria-label="削除"><img src="images/delete.png" width="18" height="18"></a>
				      </td>
				    </tr>
				    <tr>
				    	<td colspan="5" border="0"></td>
				    	<td colspan="2" align="center" aria-label="小計">小&nbsp;&nbsp;&nbsp;&nbsp;計</td>
				    	<td aria-label="小計金額">5,340</td>
				    	<td colspan="2" border="0"></td>
				    </tr>
				    <tr>
				    	<td colspan="5" border="0"></td>
				    	<td colspan="2" align="center" aria-label="消費税">消費税額</td>
				    	<td aria-label="消費税額">427</td>
				    	<td colspan="2" border="0"></td>
				    </tr>
				    <tr>
				    	<td colspan="5" border="0"></td>
				    	<td colspan="2" align="center" aria-label="合計">合&nbsp;&nbsp;&nbsp;&nbsp;計</td>
				    	<td aria-label="合計金額">5,767</td>
				    	<td colspan="2" border="0"></td>
				    </tr>
				</tbody>
			</table>
			
			
		</div>
		<div class="table_area2">
			<table class="row-head header-check">
  				<thead>
    				<tr>
				      <th width="50">出荷</th>
				      <th width="60">出荷日</th>
				      <th width="60">運送会社</th>
				      <th width="60">種類</th>
				      <th width="60">送り状番号</th>
				      <th width="50"></th>
    				</tr>
				</thead>
				<tbody>
				    <tr>
				      <td aria-label="出荷">未出荷</td>
				      <td aria-label="出荷日"></td>
				      <td aria-label="運送会社"><select><option value="ヤマト運輸">ヤマト運輸</option><option value="佐川急便">佐川急便</option><option value="日本郵便">日本郵便</option></select></td>
				      <td aria-label="種類"><input type="text" size="50"></td>
				      <td aria-label="送り状番号"><input type="text" size="50"></td>
				      <td align="center" class="bt-area">
				        <a href="mailto:##" aria-label="送信"><img src="images/sendmail.jpg" width="86" height="27"></a>
				      </td>
				    </tr>
				</tbody>
			</table>
		</div>
		<div class="table_area2">
			<table class="row-head header-check">
  				<thead>
    				<tr>
				      <th width="50">出荷</th>
				      <th width="60">出荷日</th>
				      <th width="60">運送会社</th>
				      <th width="60">種類</th>
				      <th width="60">送り状番号</th>
				      <th width="50"></th>
    				</tr>
				</thead>
				<tbody>
				    <tr>
				      <td aria-label="出荷">出荷済</td>
				      <td aria-label="出荷日">2019/07/08</td>
				      <td aria-label="運送会社">ヤマト運輸</td>
				      <td aria-label="種類">ネコポス</td>
				      <td aria-label="送り状番号">726485263220</td>
				      <td align="center" class="bt-area">
				        0002			      </td>
				    </tr>
				</tbody>
			</table>
		</div>
    </div>
</template>