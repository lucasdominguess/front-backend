import pandas as pd
# import mysql.connector as mysql
# import sqlalchemy as sql

from sqlalchemy import create_engine , text 

# df = pd.read_excel("20-HM Ignácio Proença de Gouvêa.xlsx",sheet_name="pesquisa_satisfacao")
df = pd.read_csv("logs02-05-2024.csv")

# print(table)
# exit()

sql = "mysql+pymysql://estag:123@192.168.206.38/db_estagiarios"

engine = create_engine(sql)

with engine.connect() as conn :
    # df=pd.read_sql(text("select * from estagiarios"),conn)
    df.to_sql("lucas_criou_csv",if_exists="append",index=False,con=conn)
    conn.commit()


print(df)
# table.loc[3,"RUIM"] = 2000
# table.to_excel("TestePandas2.xlsx")
#conectando banco de dados 





exit()
    # conectar= sql.connect(host='localhost',database='db_hosp',user ='root',password='')
    # table.to_sql('avaliacao',conectar,index=False,if_exists='append')
    # conectar.commit()

# dados = '' 
# comando = "Insert into avaliacao(clinica,OTIMO,BOM,REGULAR,RUIM) values('clinica[i]','otimo[i]','bom[i]','regular[i]','ruim[i]')"


# print(tabela)
