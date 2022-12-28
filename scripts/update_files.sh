root='/home/a10955psys/database_project'
#echo $root
#ls $root
cd $root
rm -r $root/* 
rm -r $root/.git
git clone https://github.com/Sunny1928/database_final_project.git
mv $root/database_final_project/* ./
mv $root/database_final_project/.git ./
rm -r $root/database_final_project


